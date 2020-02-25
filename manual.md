# How to setup the module
## Step 1. Locate the module settings inside the Magento backend 
«**STORES**» → «**Configuration**» → «**SALES**» → «**Fraud Protection**» → «**Sift**»: 
<table><tr>
	<td><img alt='«STORES» → «Configuration»' src='doc/magento/stores--configuration.png'/></td>
	<td><img alt='«SALES» → «Fraud Protection» → «Sift»' src='doc/magento/sales--fraud-protection--sift.png'/></td>
</tr></table>

## Step 2. Place your Sift credentials to the Magento backend
You need **4** Sift credentials to setup the module:
### 2.1. Account ID
#### 2.1.1. «Account ID» in Sift
<table>
	<thead><tr><th>Sandbox Mode</th><th>Production Mode</th></tr></thead>
	<tbody><tr>
		<td><img alt='«Sandbox Account ID» in Sift' src='doc/sift/credentials/sandbox/account-id.png'/></td>
		<td><img alt='«Production Account ID in Sift' src='doc/sift/credentials/production/account-id.png'/></td>
	</tr></tbody>
</table>
#### 2.1.2. «Account ID» in Magento
<img alt='«Account ID» in Magento' src='doc/magento/credentials/account-id.png'/>

### 2.2. Beacon Key
<table>
	<thead><tr><th>Sandbox Mode</th><th>Production Mode</th></tr></thead>
	<tbody><tr>
		<td><img alt='Sandbox Beacon Key' src='doc/sift/credentials/sandbox/beacon-key.png'/></td>
		<td><img alt='Production Beacon Key' src='doc/sift/credentials/production/beacon-key.png'/></td>
	</tr></tbody>
</table>

### 2.3. REST API Key
<table>
	<thead><tr><th>Sandbox Mode</th><th>Production Mode</th></tr></thead>
	<tbody><tr>
		<td><img alt='Sandbox REST API Key' src='doc/sift/credentials/sandbox/rest-api-key.png'/></td>
		<td><img alt='Production REST API Key' src='doc/sift/credentials/production/rest-api-key.png'/></td>
	</tr></tbody>
</table>

### 2.4. Signature Key
A signature key is used to [authenticate](https://sift.com/developers/docs/php/decisions-api/decision-webhooks/authentication) the [decision notifications](https://sift.com/developers/docs/php/decisions-api/decision-webhooks) received by Magento from Sift.  
The sandbox mode shares signature keys with the production mode, so turn off the «Sandbox Mode» toggle to see your signature key.
<img alt='Signature Key' src='doc/sift/credentials/signature-key.png'/>

## Step 3. Set the module's webhook URL to every Sift decision in the Sift console
...

## Step 4. Map the used Magento payment options to Sift constants
The module passes the chosen payment method to Sift within the [`$create_order`](https://sift.com/developers/docs/curl/events-api/reserved-events/create-order) event's payload.  
Sift requires that [`$payment_type` and `$payment_gateway`](https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method) field values should belong to fixed sets, so you need to setup a mapping between Magento payment methods used in your store and the allowed `$payment_type` and `$payment_gateway` values.  
The module already maps built-in Magento payment methods to reasonable `$payment_type` and `$payment_gateway` values, so you need to setup such mapping only for third-party payment modules.  
<img alt='Payment Methods' src='doc/magento/payment-methods.png'/>  