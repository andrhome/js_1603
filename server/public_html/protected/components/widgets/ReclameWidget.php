<?php
class ReclameWidget extends CWidget
{
    public $id;
    public $model;

    public function init()
    {

        if(is_int($this->id)){
            $this->model = Reclame::model()->findByPk($this->id);
        }
        else {
            $this->model = Reclame::model()->find(array('condition'=>'position = :position', 'params'=>array(':position'=>$this->id)));
        }
    }

    public function run()
    {
		if(isset($this->model))
			echo htmlspecialchars_decode($this->model->description);
    }
}