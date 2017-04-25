<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 12/12/2016
 * Time: 3:09 AM
 */

namespace Helpers;


use Plasticbrain\FlashMessages\FlashMessages;

class MaterializeFlashMessage extends FlashMessages
{
    protected $msgWrapper = '<div id="card-alert" class="%s">%s</div>';

    protected $closeBtn = '<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>';
    // Prepend and append to each message (inside of the wrapper)
    protected $msgBefore = '<div class="card-content white-text"><p>';
    protected $msgAfter  = '</p></div>';

    // CSS Classes
    protected $stickyCssClass = 'sticky';
    protected $msgCssClass = 'card';
    protected $cssClassMap = [
        self::INFO    => 'light-blue lighten-5',
        self::SUCCESS => 'green',
        self::WARNING => 'orange',
        self::ERROR   => 'red',
    ];


    protected function formatMessage($msgDataArray, $type)
    {

        $msgType = isset($this->msgTypes[$type]) ? $type : $this->defaultType;
        $cssClass = $this->msgCssClass . ' ' . $this->cssClassMap[$type];
        $msgBefore = $this->msgBefore;
        $msgAfter = $this->msgAfter;

        // If sticky then append the sticky CSS class
        if ($msgDataArray['sticky']) {
            $cssClass .= ' ' . $this->stickyCssClass;

            // If it's not sticky then add the close button
        } else {
            $msgAfter =  $msgAfter.$this->closeBtn;
        }

        // Wrap the message if necessary
        $formattedMessage = $msgBefore . $msgDataArray['message'] . $msgAfter;

        return sprintf(
            $this->msgWrapper,
            $cssClass,
            $formattedMessage
        );
    }
}