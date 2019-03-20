<?php

/**
 * Stripe Fetch Application Fee Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Application Fee Request.
 *
 * Example -- note this example assumes that the purchase has been successful
 * and that the application fee ID returned from the purchase is held in $fee_id.
 *
 * <code>
 *   // Fetch the transaction so that details can be found for refund, etc.
 *   $transaction = $gateway->fetchApplicationFee();
 *   $transaction->setTransactionId($fee_id);
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchApplicationFee response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api#retrieve_application_fee
 */
class FetchApplicationFeeRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionId');

        $data = array();

        if ($this->getStripeVersion()) {
            $data['stripe_version'] = $this->getStripeVersion();
        }

        if ($this->getStripeAccount()) {
            $data['stripe_account'] = $this->getStripeAccount();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/application_fees/'.$this->getTransactionId();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
