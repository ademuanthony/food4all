<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 9/20/2016
 * Time: 11:55 PM
 */

namespace Models;


use Framework\Base\Model;
use Globals\Utility;
use Helpers\StringMethods;

class RegistrationPin extends Model
{
    protected $pin;

    protected $serial_number;

    protected $status;

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setPin($pin)
    {
        $this->pin = $pin;
        return $this;
    }

    public function setSerialNumber($serial_number)
    {
        $this->serial_number = $serial_number;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPin()
    {
        return $this->pin;
    }

    public function getSerialNumber()
    {
        return $this->serial_number;
    }


    /**
     * @return RegistrationPin
     */
    public static function createOne(){
        try{
            $card = new RegistrationPin();
            $pin = StringMethods::GetRandomString(6, '0123456789');
            while(self::findOneBy(['pin' => $pin])){
                $pin = StringMethods::GetRandomString(6, '0123456789');
            }
            $card->setPin($pin);
            $sql = "SELECT MAX(serial_number) AS sn FROM registrationpins";
            $result = \R::getAll($sql);

            $serial_number = $result[0]['sn'] + 1;

            while(self::findOneBy(['serial_number' => str_pad($serial_number, 10, '0', STR_PAD_LEFT)])){
                $serial_number += 1;
            }

            $card->setSerialNumber(str_pad($serial_number, 10, '0', STR_PAD_LEFT));

            $card->setStatus(Status::Active);
            $card->save();
            return $card;
        }catch (\Exception $ex){
            Utility::slackDebug('Error Creating Card', $ex->getMessage());
            return false;
        }
    }

}