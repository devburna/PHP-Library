<?php
namespace RestApis\Blockchain\DOGE\TransactionAPI;

use Common\Response;
use RestApis\Blockchain\DOGE\Common;
use RestApis\Blockchain\DOGE\Snippets\Fee;
use RestApis\Blockchain\DOGE\Snippets\Output;

class TransactionSizeForHDWallet extends Common
{

    protected $network;

    /**
     * @param $network
     * @param $walletName
     * @param $password
     * @param Output $outputs
     * @param Fee|null $fee
     * @param null $locktime
     * @param null $data
     * @return \stdClass
     * @throws \Exception
     */

    public function calculate($network, $walletName, $password, Output $outputs, Fee $fee = null, $locktime = null, $data = null)
    {
        $this->network = $network;
        return (new Response(
            $this->request([
                'method' => 'POST',
                'params' =>  [
                    'walletName' => $walletName,
                    'password' => $password,
                    'outputs' => $outputs->get(),
                    'locktime' => $locktime,
                    'fee' => $fee ? $fee->get() : $fee,
                    'data' => $data
                ]
            ])
        ))->get();
    }

    protected function getEndPoint()
    {
        return $this->endpoint . '/' . $this->network . '/wallets/hd/txs/size';
    }
}
