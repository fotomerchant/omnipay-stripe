<?php
/**
 * Stripe Fetch Transaction Balance Request
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Transaction Balance Request
 *
 * Example -- note this example assumes that the purchase has been successful
 * and that the transaction balance ID returned from the purchase is held in $balance_transaction.
 * See PurchaseRequest for the first part of this example transaction:
 *
 * <code>
 *   // Fetch the transaction so that details can be found for refund, etc.
 *   $transaction = $gateway->fetchTransactionBalance();
 *   $transaction->setTransactionBalanceReference($balance_transaction);
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchTransactionBalance response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see PurchaseRequest
 * @see Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api#retrieve_balance_transaction
 */
class FetchTransactionBalanceRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionBalanceReference');

        $data = array();

        if ($this->getStripeAccount()) {
            $data['stripe_account'] = $this->getStripeAccount();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/balance/history/'.$this->getTransactionBalanceReference();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
