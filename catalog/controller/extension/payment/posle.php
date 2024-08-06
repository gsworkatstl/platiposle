<?php
  
class ControllerExtensionPaymentPosle extends Controller {
    public function index() {
        $data = array();
        $this->load->language('extension/payment/posle');

           return $this->load->view('extension/payment/posle', $data);
    }

    public function send() {
            $json = array();
            if(isset($this->session->data['payment_method']['code']) && $this->session->data['payment_method']['code'] == 'posle') {
            $this->load->language('extension/payment/posle');
    
            $this->load->model('checkout/order');
    
            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_posle_order_status_id'),'', true);
            
            $json['redirect'] = $this->url->link('checkout/success');
            }
            
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));        
    }
}
