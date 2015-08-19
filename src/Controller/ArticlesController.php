<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;

/**
* Articles Controller
*
* @property \App\Model\Table\ArticlesTable $Articles
*/
class ArticlesController extends AppController
{

  /**
  * Index method
  *
  * @return void
  */
  public function index()
  {
    $this->paginate = [
      'contain' => ['Users']
    ];
    $this->set('articles', $this->paginate($this->Articles));
    $this->set('_serialize', ['articles']);
  }

  public function addImage()
  {
    $session = $this->request->session();
    $this->viewBuilder()->layout('ajax');

    if ($this->request->is('post')){

      if(isset($this->request->data['file']) && $this->request->data['file']['error']==0){
        $file = $this->request->data['file'];

        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $file["name"]);
        $extension = end($temp);

        if ((($file["type"] == "image/gif")
        || ($file["type"] == "image/jpeg")
        || ($file["type"] == "image/jpg")
        || ($file["type"] == "image/pjpeg")
        || ($file["type"] == "image/x-png")
        || ($file["type"] == "image/png"))
        && ($file["size"] < 2000000)
        && in_array($extension, $allowedExts)) {
          if (file_exists(WWW_ROOT . DS . 'img' . DS . $file["name"])) {
            $response =  $file["name"] . " already exists. ";
          } else {
            $rand = substr(md5(microtime()),rand(0,26),5);
            move_uploaded_file($file["tmp_name"],
            WWW_ROOT . DS . 'img' . DS . $rand . '.' . $file["name"]);
            chmod(WWW_ROOT . DS . 'img'. DS . $rand . '.' . $file["name"], 0777);
            // Önce veritabanı sorgumuzu hazırlayalım.
            $response =  Router::url('/', true) .'img/' .$rand . '.' . $file["name"];
          }
        } else {
          $response = "Invalid file";
        }
      }
      }

      // Shoul add media to database
      // id, article_id, filename
      // img, common mpeg file('media library symphosize')

      $tempImage = $session->read('tempImage');

      if(empty($tempImage)){
        $tempImage = [];
      }
      if(!isset($tempImage[$response])){
        $tempImage[$response] = 1;
      }
      $session->write('tempImage', $tempImage);

      $this->set('response', $response);
      $this->set('_serialize', ['response']);
    }

    /**
    * View method
    *
    * @param string|null $id Article id.
    * @return void
    * @throws \Cake\Network\Exception\NotFoundException When record not found.
    */
    public function view($id = null)
    {
      $article = $this->Articles->get($id, [
        'contain' => ['Users']
        ]);
        $this->set('article', $article);
        $this->set('_serialize', ['article']);
      }

      public function isAuthorized($user)
      {
        // All registered users can add articles
        if ($this->request->action === 'add') {
          return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
          $articleId = (int)$this->request->params['pass'][0];
          if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
            return true;
          }
        }

        return parent::isAuthorized($user);
      }

      /**
      * Add method
      *
      * @return void Redirects on successful add, renders view otherwise.
      */
      public function add()
      {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
          $article = $this->Articles->patchEntity($article, $this->request->data);
          $article->user_id = $this->Auth->user('id');
          if ($this->Articles->save($article)) {
            $this->Flash->success(__('The article has been saved.'));
            return $this->redirect(['action' => 'index']);
          } else {
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
          }
        }
        $this->set(compact('article', 'users'));
        $this->set('_serialize', ['article']);
      }

      private function extractImages($string){
        $return  = [];

        $doc = new \DOMDocument();

        $doc->loadHTML($string);
        $xpath = new \DOMXPath($doc);
        $serverName = Router::url('/', true);
        $query = "//img/@src[starts-with(., '$serverName')]";
        $nodelist = $xpath->query($query);
        foreach ($nodelist as $element) {
          //print_r($element->value);
          array_push($return, $element->value);
          //echo $element->attributes->getNamedItem('src')->nodeValue;
        }
        return $return;
      }

      /**
      * Edit method
      *
      * @param string|null $id Article id.
      * @return void Redirects on successful edit, renders view otherwise.
      * @throws \Cake\Network\Exception\NotFoundException When record not found.
      */
      public function edit($id = null)
      {
        $session = $this->request->session();
        $article = $this->Articles->get($id, [
          'contain' => []
          ]);

          $imagesBefore = $this->extractImages($article['body']);
          if(!empty($session->read('tempImage'))){
            foreach ($session->read('tempImage') as $key => $value) {
              array_push($imagesBefore, $key);
            }
          }

          if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            //var_dump($this->request->data['body']);
            $imagesAfter = $this->extractImages($this->request->data['body']);

            $deletedImages = array_diff($imagesBefore,$imagesAfter);
            if(!empty($deletedImages)){
              foreach ($deletedImages as $file) {
                @unlink(WWW_ROOT . DS . 'img' . DS . basename($file));
              }
            }
            $article->user_id = $this->Auth->user('id');
            if ($this->Articles->save($article)) {
              $this->Flash->success(__('The article has been saved.'));
              //return $this->redirect(['action' => 'index']);
            } else {
              $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
          }
          $users = $this->Articles->Users->find('list', ['limit' => 200]);
          $this->set(compact('article', 'users'));
          $this->set('_serialize', ['article']);
        }

        /**
        * Delete method
        *
        * @param string|null $id Article id.
        * @return void Redirects to index.
        * @throws \Cake\Network\Exception\NotFoundException When record not found.
        */
        public function delete($id = null)
        {
          $this->request->allowMethod(['post', 'delete']);
          $article = $this->Articles->get($id);
          if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
          } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
          }
          return $this->redirect(['action' => 'index']);
        }
      }
