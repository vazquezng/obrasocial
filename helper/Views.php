<?php

namespace helper;

class views {

	private $template = "default";
	/**/
	private $dirTemp = "template/";
	/**/
	private $varsPrint = array();

	public function compile() {
		$this->includeFile(ROOT . $this->dirTemp . $this->template . '.php');
	}

	public function setTemplate($template) {
		$this->template = $template;
	}

	public function addVar($Nombre, $Valor) {
		$this->varsPrint[$Nombre] = $Valor;
	}

	private function includeFile($file) {
		if (count($this->varsPrint) > 0) {
			foreach ($this->varsPrint as $ViewKeys => $ViewValores) {
				if (!isset($$ViewKeys)) {
					$$ViewKeys = $ViewValores;
				}
			}
		}

		include $file;
	}
}

?>