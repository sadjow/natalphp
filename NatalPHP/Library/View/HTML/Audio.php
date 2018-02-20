<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Audio.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Audio class file.
 *
 * NatalPHP (tm) :  Sufficient and Simple Framework (http://www.trycatch.com.br)
 * Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 * Waldson Patricio <waldsonpatricio[at]gmail.com
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 *                Waldson Patricio <waldsonpatricio[at]gmail.com
 * @link          http://www.trycatch.com.br Natal(tm) Project
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 45 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 20:05:40 +0000 (Sun, 10 Jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once('Element.php');

/**
 * Class representing an Audio element.
 *
 * "The <audio> tag defines sound, such as music or other audio streams." (www.w3schools.com)
 *
 * e.g:
 * <audio src="horse.ogg" controls="controls">
 * Your browser does not support the audio element.
 * </audio>
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Audio extends Element {
    
    /**
     * Create a new Audio.
     *
     * @param string $src Defines the URL of the audio to play.
     * @param bool $isControls If present, controls will be displayed, such as a play button.
     * @param string $alertBrowserSupport Message for browsers that not support the Audio tag.
     * @param bool $isAutobuffer If present, the audio will be loaded at page load, and ready to run. autobuffer has no effect if autoplay is present.
     * @param bool $isAutoplay If present, the audio will start playing as soon as it is ready.
     */
    public function  __construct($src, $isControls = false, $alertBrowserSupport = null, $isAutobuffer = false,
            $isAutoplay = false) {

        parent::__construct('audio');

        $this->src($src);
        $this->isControls($isControls);
        $this->isAutobuffer($isAutobuffer);
        $this->isAutoplay($isAutoplay);
        if($alertBrowserSupport) $this->content($alertBrowserSupport);
    }

    /**
     * Sets or gets the autobuffer.
     *
     * @param bool $value if True or False
     * @return mixed Null if no has autobuffer, and Element if setting the autobuffer.
     */
    public function isAutobuffer($value = null){
        if($value === null)
            return $this->attr(ATTR_AUTOBUFFER, $value);
        else {
            if($value){
                return $this->attr(ATTR_AUTOBUFFER, 'autobuffer');
            } else {
                return $this->rattr(ATTR_AUTOBUFFER);
            }
        }
    }
    
    /**
     * Sets or gets the controls.
     *
     * @param bool $value if True or False
     * @return mixed Null if no has controls, and Element if setting the controls.
     */
    public function isControls($value = null){
        if($value === null)
            return $this->attr(ATTR_CONTROLS, $value);
        else {
            if($value){
                return $this->attr(ATTR_CONTROLS, 'controls');
            } else {
                return $this->rattr(ATTR_CONTROLS);
            }
        }
    }

    /**
     * Sets or gets the autoplay.
     *
     * @param bool $value if True or False
     * @return mixed Null if no has autoplay, and Element if setting the autoplay.
     */
    public function isAutoplay($value = null){
        if($value === null)
            return $this->attr(ATTR_AUTOPLAY, $value);
        else {
            if($value){
                return $this->attr(ATTR_AUTOPLAY, 'autoplay');
            } else {
                return $this->rattr(ATTR_AUTOPLAY);
            }
        }
    }

    /**
     * Sets or gets the src.
     *
     * @param bool $value Defines the URL of the audio to play.
     * @return mixed Null if no has src, and Element if setting the src.
     */
    public function src($value = null){
        return $this->attr(ATTR_SRC, $value);
    }
    
    
}