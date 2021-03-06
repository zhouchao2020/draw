<?php
include(dirname(__FILE__) . '/Smarty.class.php');
class Glo_Smarty_Adapter implements Yaf_View_Interface{
   /**
	* Smarty object
	*/
	public $_smarty;
    private static $_objSelf=null;

   /**
	* Constructor
	*
	* @param string $tmplPath
	* @param array $extraParams
    * @param boolean $isCover
	* <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	*/
    public static function getInstance($tmplPath=null, $extraParams=array(), $isCover = false){
        if (!self::$_objSelf){
            self::$_objSelf = new Glo_Smarty_Adapter($tmplPath, $extraParams, $isCover);
        }

        return self::$_objSelf;
    }

	public function __construct($tmplPath = null, $extraParams = array(), $isCover = false) {
	 	$this->_smarty = new Smarty();
		if (null !== $tmplPath) {
				$this->setScriptPath($tmplPath);
		}

        $objConf = Glo_Conf::getConf('global.ini', 'smart');
        $arrConf = $objConf->toArray();
        if (is_array($arrConf) && !$isCover){
            $extraParams = $extraParams + $arrConf;
        }

		foreach ($extraParams as $key => $value) {
				$this->_smarty->$key = $value;
		}
	 }


	/**
	 * Return the template engine object
	 *
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  Smarty
	 */
	public function getEngine() {
		return $this->_smarty;
	}

	/**
	 * Set the path to the templates
	 *
	 * @param string $path The directory to set as the path.
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	 */
	public function setScriptPath($path)
	{
		if (is_readable($path)) {
			$this->_smarty->template_dir = $path;
			return;
		}

		throw new Exception('Invalid path provided');
	}

	/**
	 * Retrieve the current template directory
	 *
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  string
	 */
	public function getScriptPath()
	{
		return $this->_smarty->template_dir;
	}

	/**
	 * Alias for setScriptPath
	 *
	 * @param string $path
	 * @param string $prefix Unused
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	 */
	public function setBasePath($path, $prefix = 'Zend_View')
	{
		return $this->setScriptPath($path);
	}

	/**
	 * Alias for setScriptPath
	 *
	 * @param string $path
	 * @param string $prefix Unused
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	 */
	public function addBasePath($path, $prefix = 'Zend_View')
	{
		return $this->setScriptPath($path);
	}

	/**
	 * Assign a variable to the template
	 *
	 * @param string $key The variable name.
	 * @param mixed $val The variable value.
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	 */
	public function __set($key, $val)
	{
		$this->_smarty->assign($key, $val);
	}

	/**
	 * Allows testing with empty() and isset() to work
	 *
	 * @param string $key
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  boolean
	 */
	public function __isset($key)
	{
			return (null !== $this->_smarty->get_template_vars($key));
	}

	/**
	 * Allows unset() on object properties to work
	 *
	 * @param string $key
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	 */
	public function __unset($key)
	{
			$this->_smarty->clear_assign($key);
	}

	/**
	 * Assign variables to the template
	 *
	 * Allows setting a specific key to the specified value, OR passing
	 * an array of key => value pairs to set en masse.
	 *
	 * <a href="http://my.oschina.net/u/244147" class="referer" target="_blank">@see</a>  __set()
	 * @param string|array $spec The assignment strategy to use (key or
	 * array of key => value pairs)
	 * @param mixed $value (Optional) If assigning a named variable,
	 * use this as the value.
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	 */
	public function assign($spec, $value = null) {
			if (is_array($spec)) {
					$this->_smarty->assign($spec);
					return;
			}

			$this->_smarty->assign($spec, $value);
	}

	/**
	 * Clear all assigned variables
	 *
	 * Clears all variables assigned to Zend_View either via
	 * {<a href="http://my.oschina.net/link1212" class="referer" target="_blank">@link</a>  assign()} or property overloading
	 * ({<a href="http://my.oschina.net/link1212" class="referer" target="_blank">@link</a>  __get()}/{<a href="http://my.oschina.net/link1212" class="referer" target="_blank">@link</a>  __set()}).
	 *
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  void
	 */
	public function clearVars() {
		$this->_smarty->clear_all_assign();
	}

	/**
	 * Processes a template and returns the output.
	 *
	 * @param string $name The template to process.
	 * <a href="http://my.oschina.net/u/556800" class="referer" target="_blank">@return</a>  string The output.
	 */
	public function render($name, $value = NULL) {
		return $this->_smarty->fetch($name);
	}

	public function display($name, $value = NULL) {
		echo $this->_smarty->fetch($name);
	}
}
