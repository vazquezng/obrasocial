<?php
/**
 *
 * @author nicolas.v
 */

namespace core;

class Request {
	const METHOD_POST = 'POST';
	const METHOD_PUT = 'PUT';
	const METHOD_GET = 'GET';
	const METHOD_DELETE = 'DELETE';

	/**
	 * @var string
	 */
	private $identifier;

	/**
	 * @var array
	 */
	private $postParams;

	/**
	 * @var array
	 */
	private $getParams;
	/**
	 * @var string
	 */
	private $method;

	// ---------------------------------------------------------------------------
	/**
	 */
	public function __construct() {
		$this->postParams = $_POST;
		$this->getParams = $_GET;

		$this->method = strtoupper($_SERVER['REQUEST_METHOD']);
		$this->identifier = uniqid("rq_", true);
	}

	// -------------------------------------------------------------------------
	/**
	 * Agrega parámetros de forma manual al array correspondiente al método indicado.
	 *
	 * @param string $httpMethod
	 * @param array  $params
	 */
	public function addParams($httpMethod, array $params) {
		switch ($httpMethod) {

		case self::METHOD_GET:
			$this->getParams = array_merge($this->getParams, $params);
			break;

		case self::METHOD_POST:
			$this->postParams = array_merge($this->postParams, $params);
			break;

		default:
			throw new \Exception('You cannot add parameters to [' . $httpMethod . '] method');
		}
	}

	// -------------------------------------------------------------------------
	/**
	 * @return string
	 */
	public function getPostBody() {
		$postBody = file_get_contents('php://input');
		return $postBody;
	}

	// ---------------------------------------------------------------------------
	/**
	 * @return array
	 */
	public function getPostParams($paramNames = array()) {
		if (!empty($paramNames)) {
			return $this->getParamsByKeys($this->postParams, $paramNames);
		}
		return $this->postParams;
	}

	// ---------------------------------------------------------------------------
	/**
	 * @return boolean
	 */
	public function getGetParams($paramNames = array()) {
		if (!empty($paramNames)) {
			return $this->getParamsByKeys($this->getParams, $paramNames);
		}
		return $this->getParams;
	}

	// -------------------------------------------------------------------------
	/**
	 * @param  array $array
	 * @param  array $keys
	 * @return array
	 */
	private function getParamsByKeys(array $array, array $keys) {
		$return = array();
		foreach ($keys as $key) {
			if (isset($array[$key])) {
				$return[$key] = $array[$key];
			}
		}
		return $return;
	}

	// -------------------------------------------------------------------------
	/**
	 * Returns the http method of the request
	 *
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  string $paramName
	 * @return mixed
	 */
	public function getPostParameter($paramName) {
		return $this->get($this->postParams, $paramName);
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  string $paramName
	 * @return mixed
	 * @throws \Exceptions
	 */
	public function getGetParameter($paramName) {
		return $this->get($this->getParams, $paramName);
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  string $paramName
	 * @return string
	 * @throws \Exceptions
	 */
	public function getRequestParameter($paramName) {
		if ($this->existsRequestParameter($paramName)) {
			if ($this->existsPostParameter($paramName)) {
				return $this->getPostParameter($paramName);
			} else {
				return $this->getGetParameter($paramName);
			}
		} else {
			throw new \Exception('Missing parameter ' . $paramName);
		}
	}

	// -------------------------------------------------------------------------
	/**
	 * @return array
	 */
	public function getRequestParams() {
		return array_merge($this->getParams, $this->postParams);
	}

	// -------------------------------------------------------------------------
	/*
	     * @param  string $paramName
	     * @param  mixed  $elseReturn
	     * @return mixed
	     * @throws \Exceptions
*/
	public function getIfExistsGetParameter($paramName, $elseReturn = null) {
		$parameter = $elseReturn;

		if ($this->existsGetParameter($paramName)) {
			$parameter = $this->getGetParameter($paramName);
		}

		return $parameter;
	}
	// -------------------------------------------------------------------------
	/*
	     * @param  string $paramName
	     * @param  mixed  $elseReturn
	     * @return mixed
	     * @throws \Exceptions
*/
	public function getIfExistsPostParameter($paramName, $elseReturn = null) {
		$parameter = $elseReturn;

		if ($this->existsPostParameter($paramName)) {
			$parameter = $this->getPostParameter($paramName);
		}

		return $parameter;
	}

	// -------------------------------------------------------------------------
	public function getIfExistsRequestParameter($paramName, $elseReturn = null) {
		$parameter = $elseReturn;

		if ($this->existsRequestParameter($paramName)) {
			$parameter = $this->getRequestParameter($paramName);
		}

		return $parameter;
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  string  $paramName
	 * @return boolean
	 */
	public function existsPostParameter($paramName) {
		return $this->exist($this->postParams, $paramName);
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  string  $paramName
	 * @return boolean
	 */
	public function existsGetParameter($paramName) {
		return $this->exist($this->getParams, $paramName);
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  string $paramName
	 * @return boolean
	 */
	public function existsRequestParameter($paramName) {
		return $this->exist($this->getParams, $paramName) || $this->exist($this->postParams, $paramName);
	}

	// -------------------------------------------------------------------------
	/**
	 * @return
	 */
	public function getRequestURI() {
		return $_SERVER['REQUEST_URI'];
	}

	// -------------------------------------------------------------------------
	public function getRequestHost() {
		return $_SERVER['HTTP_HOST'];
	}

	// -------------------------------------------------------------------------
	public function getRequestReferer() {
		$referer = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
		return $referer;
	}

	// -------------------------------------------------------------------------
	public function getRequestBrowser() {
		$ua = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
		return $ua;
	}

	// -------------------------------------------------------------------------
	/**
	 * Current client ip
	 * @return string
	 */
	public static function getIp() {
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
			if (array_key_exists($key, $_SERVER) === true) {
				foreach (explode(',', $_SERVER[$key]) as $ip) {
					$ip = trim($ip); // just to be safe

					if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
						return $ip;
					}
				}
			}
		}

		return "8.8.8.8";
	}

	// -------------------------------------------------------------------------
	/**
	 * Verifies if the request type is Xml Http Request (XHR or Ajax)
	 *
	 * @return boolean
	 */
	public function isXHR() {
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  array  $parameters
	 * @param  string $parameterName
	 * @return mixed
	 * @throws \Exceptions
	 */
	private function get($parameters, $parameterName) {
		if ($this->exist($parameters, $parameterName)) {
			return $parameters[$parameterName];
		}

		throw new \Exception('Missing parameter ' . $parameterName);
	}

	// ---------------------------------------------------------------------------
	/**
	 * @param  array   $parameters
	 * @param  string  $parameterName
	 * @return boolean
	 */
	private function exist($parameters, $parameterName) {
		return isset($parameters[$parameterName]);
	}

}
