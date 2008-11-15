<?php
/*
	accounts/ap/invoices-payments.php
	
	access: account_ap_view

	Displays and allows creation/adjustment/deletion of payments against the invoice.
	
*/

// custom includes
require("include/accounts/inc_invoices.php");
require("include/accounts/inc_invoices_items.php");
require("include/accounts/inc_charts.php");


if (user_permissions_get('accounts_ap_view'))
{
	$id = $_GET["id"];

	// nav bar options.
	$_SESSION["nav"]["active"]	= 1;
	
	$_SESSION["nav"]["title"][]	= "Invoice Details";
	$_SESSION["nav"]["query"][]	= "page=accounts/ap/invoice-view.php&id=$id";

	$_SESSION["nav"]["title"][]	= "Invoice Items";
	$_SESSION["nav"]["query"][]	= "page=accounts/ap/invoice-items.php&id=$id";
	
	$_SESSION["nav"]["title"][]	= "Invoice Payments";
	$_SESSION["nav"]["query"][]	= "page=accounts/ap/invoice-payments.php&id=$id";
	$_SESSION["nav"]["current"]	= "page=accounts/ap/invoice-payments.php&id=$id";
	
	$_SESSION["nav"]["title"][]	= "Invoice Journal";
	$_SESSION["nav"]["query"][]	= "page=accounts/ap/journal.php&id=$id";

	if (user_permissions_get('accounts_ap_write'))
	{
		$_SESSION["nav"]["title"][]	= "Delete Invoice";
		$_SESSION["nav"]["query"][]	= "page=accounts/ap/invoice-delete.php&id=$id";
	}


	function page_render()
	{
		$id		= security_script_input('/^[0-9]*$/', $_GET["id"]);


		/*
			Title + Summary
		*/
		print "<h3>INVOICE PAYMENTS</h3><br>";
		print "<p>This page shows all payments made against this invoice and allows you to edit them.</p>";

		invoice_render_summarybox("ap", $id);

		invoice_list_items_payments("ap", $id, "accounts/ap/invoice-payments-edit.php", "accounts/ap/invoice-payments-delete-process.php");


	} // end page_render

} // end of if logged in
else
{
	error_render_noperms();
}

?>