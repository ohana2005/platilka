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
    public function executeShow(sfWebRequest $request)
    {
        $this->Transaction = $Transaction = Q::f('Transaction', $request->getParameter('id'));
        $this->forward404Unless($Transaction && $Transaction->hash == $request->getParameter('hash'));
    }

    public function executePay(sfWebRequest $request)
    {
        $this->Transaction = $Transaction = Q::f('Transaction', $request->getParameter('id'));
        $this->forward404Unless($Transaction && $Transaction->hash == $request->getParameter('hash'));

        $this->Transaction->status = 'paid';
        $this->Transaction->save();

        return $this->redirect($this->makeUrl($this->Transaction->url_success, $this->Transaction));


    }

    public function executeCancel(sfWebRequest $request)
    {
        $this->Transaction = $Transaction = Q::f('Transaction', $request->getParameter('id'));
        $this->forward404Unless($Transaction && $Transaction->hash == $request->getParameter('hash'));

        $this->Transaction->status = 'cancelled';
        $this->Transaction->save();

        return $this->redirect($this->makeUrl($this->Transaction->url_cancel, $this->Transaction));
    }

    protected function makeUrl($url, $Transaction)
    {
        $signature = sha1($Transaction->Client->client_key . $Transaction->Client->client_secret . $Transaction->sum . $Transaction->currency);
        $delim = strpos($url, '?') === false ? '?' : '&';
        $url .= $delim .'objectid=' . $Transaction->objectid;
        $url .= '&signature=' . $signature;
        if($Transaction->params){
            $url .= '&' . $Transaction->params;
        }
        return $url;
    }

}
