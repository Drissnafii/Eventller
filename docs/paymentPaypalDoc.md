The following JSON data contains the payment details returned from the PayPal response.

How to use it with payment.twig:
1. After PayPal payment completion, the 'onApprove' function receives these details
2. Check response status - must be "COMPLETED"
3. Send required data to '/create-ticket' endpoint:
    - Payment ID: details.id
    - Status: details.status
    - Amount: details.purchase_units[0].amount.value
    - Currency: details.purchase_units[0].amount.currency_code
    - Payer Email: details.payer.email_address
    - Payment Time: details.create_time

Example response structure:
```json
{
  "id": "5O190127TN364715T",
  "status": "COMPLETED",
  "purchase_units": [{
     "amount": {
        "currency_code": "USD",
        "value": "100.00"
     }
  }],
  "payer": {
     "email_address": "buyer@email.com"
  },
  "create_time": "2023-01-01T00:00:00Z"
}
```

If status !== "COMPLETED", redirect back to payment page with error message.
