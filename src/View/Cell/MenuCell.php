<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Menu cell
 */
class MenuCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
      $this->set('session', $this->request->session());
      $this->loadModel('Categories');
      $categories = $this->Categories->getMenu();
      $this->set(compact('categories'));
      $this->set('_serialize', ['categories']);
    }
}
