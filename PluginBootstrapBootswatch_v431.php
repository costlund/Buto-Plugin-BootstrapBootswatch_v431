<?php
class PluginBootstrapBootswatch_v431{
  public static function widget_include($data){
    $data = new PluginWfArray($data);
    /**
     * Set other theme in session via querystring.
     */
    if(wfRequest::get('bootstrap_bootswatch_v431_theme')){
      /**
       * Check if the theme exist.
       */
      $availible = wfSettings::getSettings('/plugin/bootstrap/bootswatch_v431/theme/availible.yml');
      if(array_search(wfRequest::get('bootstrap_bootswatch_v431_theme'), $availible)!==false){
        $_SESSION['plugin']['bootstrap']['bootswatch_v431']['theme'] = wfRequest::get('bootstrap_bootswatch_v431_theme');
      }
    }
    /**
     * Set theme.
     */
    if(isset($_SESSION['plugin']['bootstrap']['bootswatch_v431']['theme'])){
      /**
       * If set in Session.
       */
      $data->set('data/theme', $_SESSION['plugin']['bootstrap']['bootswatch_v431']['theme']);
    }elseif(!$data->get('data/theme')){
      /**
       * If not set in widget we set Cerulean as default theme.
       */
      $data->set('data/theme', 'Cerulean');
    }else{
      /**
       * The theme is not in session and is set in widget.
       */
    }
    /**
     * Set current theme to pic upp in selectbox widget.
     */
    wfArray::set($GLOBALS, 'sys/settings/plugin/bootstrap/bootswatch_v431/current_theme', $data->get('data/theme'));
    /**
     * Create element and render.
     */
    $element = array();
    $element[] = wfDocument::createHtmlElement('link', null, array('href' => '/plugin/bootstrap/bootswatch_v431/'.strtolower($data->get('data/theme')).'/bootstrap.min.css', 'rel' => 'stylesheet'));
    /**
     * Spacelab fix
     */
    if(strtolower($data->get('data/theme'))=='spacelab'){
      $element[] = wfDocument::createHtmlElement('style', ".form-control::-webkit-input-placeholder{color:#777;opacity:0.4}.form-control::-ms-input-placeholder{color:#777;opacity:0.4}.form-control::placeholder{color:#777;opacity:0.4}");
    }
    /**
     * Cerulean fix
     */
    if(strtolower($data->get('data/theme'))=='cerulean'){
      $element[] = wfDocument::createHtmlElement('style', "h1,h2,h3,h4,h5,h6{color:#495057} .navbar button{margin-right:5px} ");
    }
    /**
     * 
     */
    wfDocument::renderElement($element);
  }
  public static function widget_selectbox($data){
    wfPlugin::includeonce('wf/array');
    /**
     * Get settings to pic up default class and method.
     */
    $settings = new PluginWfArray($GLOBALS['sys']['settings']);
    /**
     * Current theme.
     */
    $current_theme = wfArray::get($GLOBALS, 'sys/settings/plugin/bootstrap/bootswatch_v431/current_theme');
    /**
     * Create select.
     */
    $select = wfDocument::createHtmlElementAsObject('select');
    $select->set('attribute/onchange', "location.href='/".$settings->get('default_class')."/".$settings->get('default_method')."/bootstrap_bootswatch_v431_theme/'+this.options[this.selectedIndex].text;");
    $availible = wfSettings::getSettings('/plugin/bootstrap/bootswatch_v431/theme/availible.yml');
    $option = array();
    $option[] = wfDocument::createHtmlElement('option', '', array('value' => ''));
    foreach ($availible as $key => $value) {
      $attribute = array('value' => $value);
      if($value == $current_theme){
        $attribute = array_merge($attribute, array('selected' => 'selected'));
      }
      $option[] = wfDocument::createHtmlElement('option', $value, $attribute, array('i18n' => false));
    }
    $select->set('innerHTML', $option);
    /**
     * Render.
     */
    wfDocument::renderElement(array($select->get()));
  }
}