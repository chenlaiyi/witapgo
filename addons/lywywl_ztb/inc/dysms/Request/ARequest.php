<?php
 namespace Flc\Dysms\Request; abstract class ARequest implements IRequest { protected $action; protected $params = array(); public function getAction() { return $this->action; } public function getParams() { return $this->params; } }
