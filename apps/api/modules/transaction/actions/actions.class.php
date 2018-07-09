<?php

/**
 * transaction actions.
 *
 * @package    cms
 * @subpackage transaction
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transactionActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeNew(sfWebRequest $request)
    {
        $data = json_decode(file_get_contents('php://input'), true);


        $Client = Q::c('Client', 'c')
            ->where('c.client_key = ?', $data['client_key'])
            ->fetchOne()
            ;
        if(!$Client){
            return $this->errorResponse('Client does not exist', 1, $data);
        }

        if(!$Client->gateway_id){
            return $this->errorResponse('Client gateway not configured', 2, $data);
        }

        if(!$this->checkClientSignature($Client, $data)){
            return $this->errorResponse('Invalid client signature', 3, $data);
        }

        $Tran = new Transaction();
        $Tran->fromArray([
            'client_id' => $Client->id,

            'gateway_id' => $Client->gateway_id,

            'sum' => $data['sum'],
            'currency' => $data['currency'],
            'product' => $data['product'],
            'description' => $data['description'],
            'url_success' => $data['url_success'],
            'url_cancel' => $data['url_cancel'],
            'url_failure' => $data['url_failure'],
            'objectid' => $data['objectid'],
            'params' => !empty($data['params']) ? $data['params'] : '',
            'hash' => sha1(md5(microtime() . $Client->id . $data['sum']))
        ]);
        $Tran->save();

        $this->getResponse()->setContentType('application/json');
        return $this->renderText(json_encode([
            'type' => 'success',
            'transactionId' => $Tran->id,
            'transactionHash' => $Tran->hash
        ]));

    }

    protected function checkClientSignature($Client, $data){
        return true;
    }

    protected function errorResponse($message, $errorcode = 1, $data = []){
        $this->getResponse()->setContentType('application/json');
        $this->writeLog($message, $errorcode, $data);
        return $this->renderText(json_encode([
            'type' => 'error',
            'errorcode' => $errorcode,
            'message' => $message
        ]));
    }

    protected function writeLog($message, $errorcode, $data){
        $Log = new ApiLog;
        $Log->fromArray([
            'message' => $message,
            'errorcode' => $errorcode,
            'info' => serialize($data)
        ]);
        $Log->save();
    }
}
