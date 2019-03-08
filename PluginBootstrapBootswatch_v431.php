<?php
class PluginBootstrapBootswatch_v431{
  public static function widget_include($data){
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
      $data['data']['theme'] = $_SESSION['plugin']['bootstrap']['bootswatch_v431']['theme'];
    }elseif(!isset($data['data']['theme'])){
      /**
       * If not set in widget we set Cerulean as default theme.
       */
      $data['data']['theme'] = 'Cerulean';
    }else{
      /**
       * The theme is not in session and is set in widget.
       */
    }
    /**
     * Set current theme to pic upp in selectbox widget.
     */
    wfArray::set($GLOBALS, 'sys/settings/plugin/bootstrap/bootswatch_v431/current_theme', $data['data']['theme']);
    /**
     * Create element and render.
     */
    $element = array();
    $element[] = wfDocument::createHtmlElement('link', null, array('href' => '/plugin/bootstrap/bootswatch_v431/'.strtolower($data['data']['theme']).'/bootstrap.min.css', 'rel' => 'stylesheet'));
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
      $option[] = wfDocument::createHtmlElement('option', $value, $attribute);
    }
    $select->set('innerHTML', $option);
    /**
     * Render.
     */
    wfDocument::renderElement(array($select->get()));
  }
}