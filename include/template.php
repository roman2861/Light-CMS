<?

class Template {

    public  $dir = '.';
    public  $template = null;
    public  $copy_template = null;
    public  $data = array();
    public  $block_data = array();
    public  $result = array('info' => '', 'content' => '');
    public  $template_parse_time = 0;

//задаём параметры основных переменных подгрузки шаблона

    public function set($name , $var) {
        if (is_array($var) && count($var)) {
            foreach ($var as $key => $key_var) {
                $this->set($key , $key_var);
            } } else $this->data[$name] = $var;
    }

//обозначаем блоки

    public function set_block($name , $var) {
        if (is_array($var) && count($var)) {
            foreach ($var as $key => $key_var) {
                $this->set_block($key , $key_var);
            } } else $this->block_data[$name] = $var;
    }

//производим загрузку каркасного шаблона

    public function load_template($tpl_name) {
    $time_before = $this->get_real_time();
        if ($tpl_name == '' || !file_exists($this->dir . DIRECTORY_SEPARATOR . $tpl_name)) { die ("Невозможно загрузить шаблон: ". $tpl_name); return false;}
        $this->template = file_get_contents($this->dir . DIRECTORY_SEPARATOR . $tpl_name);
        if ( stristr( $this->template, "{include file=" ) ) {
            $this->template = preg_replace( "#\\{include file=['\"](.+?)['\"]\\}#ies","\$this->sub_load_template('\\1')", $this->template);
        }
        $this->copy_template = $this->template;
    $this->template_parse_time += $this->get_real_time() - $time_before;
    return true;
    }

// этой функцией загружаем "подшаблоны" 

    public function sub_load_template($tpl_name) {
        if ($tpl_name == '' || !file_exists($this->dir . DIRECTORY_SEPARATOR . $tpl_name)) { die ("Невозможно загрузить шаблон: ". $tpl_name); return false;}
        $template = file_get_contents($this->dir . DIRECTORY_SEPARATOR . $tpl_name);
        return $template;
    }

// очистка переменных шаблона
    public function _clear() {
    $this->data = array();
    $this->block_data = array();
    $this->copy_template = $this->template;
    }

    public function clear() {
    $this->data = array();
    $this->block_data = array();
    $this->copy_template = null;
    $this->template = null;
    }
//полная очистка включая результаты сборки шаблона
    public function global_clear() {
    $this->data = array();
    $this->block_data = array();
    $this->result = array();
    $this->copy_template = null;
    $this->template = null;
    }
//сборка шаблона в единое целое
    public function compile($tpl) {
    $time_before = $this->get_real_time();
    foreach ($this->data as $key_find => $key_replace) {
                $find[] = $key_find;
                $replace[] = $key_replace;
            }
    $result = str_replace($find, $replace, $this->copy_template);
    if (count($this->block_data)) {
        foreach ($this->block_data as $key_find => $key_replace) {
                $find_preg[] = $key_find;
                $replace_preg[] = $key_replace;
                }
    $result = preg_replace($find_preg, $replace_preg, $result);
    }
    if (isset($this->result[$tpl])) $this->result[$tpl] .= $result; else $this->result[$tpl] = $result;
    $this->_clear();
    $this->template_parse_time += $this->get_real_time() - $time_before;
    }
//счётчик времени выполнения запросов сборки
    public function get_real_time()
    {
        list($seconds, $microSeconds) = explode(' ', microtime());
        return ((float)$seconds + (float)$microSeconds);
    }
}