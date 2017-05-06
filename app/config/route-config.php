<?php
use \Globals\AppService;
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 8:32 AM
 */

//use Symfony\Component\HttpFoundation\Response;

/** @var Framework\Core $app */

//Frontend
$app->map(AppService::RouteHome, '/', "\\Controllers\\HomeController::IndexAction");
$app->map(AppService::RouteAbout, '/about', '\\Controllers\\HomeController::AboutAction');
$app->map(AppService::CompensationPlan, '/compensation', '\\Controllers\\HomeController::CompensationAction');
$app->map(AppService::Gallery, '/gallery', '\\Controllers\\HomeController::GalleryAction');
$app->map(AppService::Faq, '/faq', '\\Controllers\\HomeController::FaqAction');
$app->map(AppService::HowItWorks, '/how-it-works', '\\Controllers\\HomeController::HowItWorksAction');
$app->map(AppService::Register, '/join-now', '\\Controllers\\AccountController::RegisterAction');
$app->map(AppService::Login, '/login', '\\Controllers\\AccountController::LoginAction');
$app->map(AppService::Contact, '/contact', '\\Controllers\\HomeController::ContactAction');


//mlm
$app->map(AppService::ControlPanel, '/cpanel', '\\Controllers\\Backend\\DashboardController::IndexAction');
$app->map(AppService::Genealogy, '/genealogy', '\\Controllers\\Backend\\GenealogyController::IndexAction');
$app->map(AppService::Genealogy_Direct_Down_Line, '/genealogy/direct', '\\Controllers\\Backend\\GenealogyController::DirectAction');
$app->map(AppService::Genealogy_My_Down_Line_tree, '/genealogy/tree', '\\Controllers\\Backend\\GenealogyController::TreeAction');
$app->map(AppService::Genealogy_My_Down_Line_List, '/genealogy/list', '\\Controllers\\Backend\\GenealogyController::ListAction');

$app->map(AppService::Earnings, '/earnings', '\\Controllers\\backend\\EarningsController::IndexAction');
$app->map(AppService::GenealogySearch, '/genealogy/search', '\\Controllers\Backend\GenealogyController::SearchAction');
$app->map(AppService::Profile, '/account', '\\Controllers\\Backend\\AccountController::IndexAction');
$app->map(AppService::UPDATE_PERSONAL_INFORMATION, '/account/personalinformation/update', '\\Controllers\\Backend\\AccountController::UpdatePersonalInformationAction');
$app->map(AppService::UPDATE_CONTACT_INFORMATION, '/account/contactinformation/update', '\\Controllers\\Backend\\AccountController::UpdateContactInformationAction');
$app->map(AppService::UPDATE_NEXT_OF_KIN, '/account/nextofkin/update', '\\Controllers\\Backend\\AccountController::UpdateNextOfKinAction');
$app->map(AppService::PASSWORD_RESET, '/account/changepassword', '\\Controllers\\Backend\\AccountController::ChangePasswordAction');
$app->map(AppService::PIN_RESET, '/account/changepin', '\\Controllers\\Backend\\AccountController::ChangePinAction');

$app->map(AppService::UPDATE_BANK_DETAIL, '/account/bank/update', '\\Controllers\\Backend\\AccountController::UpdateBankDetailAction');

$app->map(AppService::Shop, '/shop', '\\Controllers\\Shop\\ProductController::IndexAction');
$app->map(AppService::BuyFood, '/shop/products', '\\Controllers\\Shop\\ProductController::IndexAction');
$app->map(AppService::Pin, '/shop/pin', '\\Controllers\\Shop\\PinController::IndexAction');
$app->map(AppService::BuyPin, '/shop/pin/buy', '\\Controllers\\Shop\\PinController::BuyAction');

$app->map(AppService::Transactions, '/transactions', '\\Controllers\\Backend\\TransactionController::IndexAction');
$app->map(AppService::FundTransfers, '/transactions/transfers', '\\Controllers\\Backend\\TransactionsController::TransfersAction');
$app->map(AppService::SendMoney, '/transactions/sendmoney', '\\Controllers\\Backend\\TransactionsController::SendMoneyAction');
$app->map(AppService::Transaction_Histories, '/transactions/histories', '\\Controllers\\Backend\\TransactionController::HistoriesAction');

$app->map(AppService::Payment_Pay, '/payment/pay/{order_ref}', '\\Controllers\\Shop\\PaymentController::PayAction');
$app->map(AppService::Payment_Success, '/payment/success', '\\Controllers\\Shop\\PaymentController::SuccessAction');
$app->map(AppService::Payment_Failed, '/payment/failed', '\\Controllers\\Shop\\PaymentController::FailedAction');
$app->map(AppService::Payment_Pending, '/payment/pending', '\\Controllers\\Shop\\PaymentController::PendingAction');
$app->map(AppService::Payment_Cancelled, '/payment/cancelled', '\\Controllers\\Shop\\PaymentController::CancelledAction');


/*
$app->map('hello', '/hello/{name}', function ($name) {
    return new Response('Hello '.$name);
});
*/

//Backend
$app->map(AppService::RouteBackendDashboard, '/backend', '\\Controllers\\Backend\\DashboardController::IndexAction');

$app->map(AppService::RouteBackendCategories, '/backend/categories', '\\Controllers\\Backend\\CategoryController::IndexAction');
$app->map(AppService::RouteBackendAddCategory, '/backend/categories/add', '\\Controllers\\Backend\\CategoryController::AddAction');
$app->map(AppService::RouteBackendManageCategory, '/backend/categories/manage/{id}', '\\Controllers\\Backend\\CategoryController::ManageAction');
$app->map(AppService::RouteBackendDeleteCategory, '/backend/categories/delete/{id}', '\\Controllers\\Backend\\CategoryController::DeleteAction');

$app->map(AppService::RouteBackendProducts, '/backend/products', '\\Controllers\\Backend\\ProductController::IndexAction');
$app->map(AppService::RouteBackendAddProduct, '/backend/products/add', '\\Controllers\\Backend\\ProductController::AddAction');
$app->map(AppService::RouteBackendManageProduct, '/backend/products/manage/{id}', '\\Controllers\\Backend\\ProductController::ManageAction');
$app->map(AppService::RouteBackendDeleteProduct, '/backend/products/delete/{id}', '\\Controllers\\Backend\\ProductController::DeleteAction');

$app->map(AppService::RouteBackendOrders, '/backend/orders', '\\Controllers\\Backend\\OrdersController::IndexAction');

$app->map(AppService::RouteBackendCustomers, '/backend/customers', '\\Controllers\\Backend\\CustomerController::IndexAction');

$app->map(AppService::RouteBackendSettings, '/backend/settings', '\\Controllers\\Backend\\SettingsController::IndexAction');
$app->map(AppService::RouteBackendSettingsSaveInformation, '/backend/settings/saveinfo', '\\Controllers\\Backend\\SettingsController::SaveBasicInformationAction');
$app->map(AppService::RouteBackendSettingChangeTheme, '/backend/settings/changetheme', '\\Controllers\\Backend\\SettingsController::ChangeThemeAction');
$app->map(AppService::RouteBackendSettingsAddSliders, '/backend/settings/addslider', '\\Controllers\\Backend\\SettingsController::AddSliderAction');
$app->map(AppService::RouteBackendSettingDeleteSlider, '/backend/settings/deleteslider/{id}', '\\Controllers\\Backend\\SettingsController::DeleteSliderAction');

//API
$app->map(AppService::API_Member, '/api/member/get', '\\Controllers\\Api\\RefController::GetMemberAction');

//mlm
$app->map(AppService::Login, '/login', '\\Controllers\\Backend\\AccountController::LoginAction');
$app->map(AppService::Logout, '/logout', '\\Controllers\Backend\\AccountController::LogoutAction');
$app->map(AppService::Register, '/join-now', '\\Controllers\Backend\\AccountController::RegisterAction');
$app->map(AppService::RegisterStep2, '/pay-fee', '\\Controllers\Backend\\AccountController::RegisterStep2Action');
$app->map(AppService::ForgotPassword, '/forgotpassword', '\\Controllers\\Backend\\AccountController::ForgotPasswordAction');
$app->map(AppService::AddAccount, '/account/add', '\\Controllers\\Backend\\AccountController::AddAccountAction');

$app->map(AppService::Notifications, '/notifications', '\\Controllers\\Backend\\NotificationController::IndexAction');
$app->map(AppService::ReadNotification, '/notifications/read/{id}', '\\Controllers\\Backend\\NotificationController::ReadAction');

//Campaigns
$app->map(AppService::BackendCampaigns, '/backend/campaigns', '\\Controllers\\Backend\\CampaignsController::IndexAction');
$app->map(AppService::BackendCampaignAdd, '/backend/campaigns/add', '\\Controllers\\Backend\\CampaignsController::AddAction');
$app->map(AppService::BackendCampaignDelete, '/backend/campaigns/delete', '\\Controllers\\Backend\\CampaignsController::DeleteAction');
$app->map(AppService::BackendCampaignDetails, '/backend/campaigns/manage', '\\Controllers\\Backend\\CampaignsController::ManageAction');

$app->map(AppService::FrontendCampaigns, '/tools', '\\Controllers\\Backend\\ToolsController::IndexAction');
$app->map(AppService::FrontendCampaignsShare, '/tools/share/{campaign_id}/{network}', '\\Controllers\\Backend\\ToolsController::SocialShareAction');


//frontend
$app->map(AppService::RouteFrontendViewCategory, '/category/{permalink}', '\\Controllers\\CategoryController::IndexAction');


$app->map(AppService::RouteFrontendProducts, '/products', '\\Controllers\\Shop\\ProductController::IndexAction');
$app->map(AppService::RouteFrontendViewProduct, '/products/{permalink}', '\\Controllers\\Shop\\ProductController::ViewAction');

$app->map(AppService::RouteCart, '/cart', '\\Controllers\\Shop\\CartController::IndexAction');
$app->map(AppService::RouteAddToCart, '/cart/add/{product_id}/{qnt}', '\\Controllers\\Shop\\CartController::AddAction');
$app->map(AppService::RouteIncreaseCartItem, '/cart/increase/{product_id}/{qnt}', '\\Controllers\\Shop\\CartController::IncreaseAction');
$app->map(AppService::RouteReduceCartItem, '/cart/reduce/{product_id}/{qnt}', '\\Controllers\\Shop\\CartController::ReduceAction');
$app->map(AppService::RouteRemoveFromCart, '/cart/remove/{product_id}', '\\Controllers\\Shop\\CartController::RemoveAction');
$app->map(AppService::RouteCheckout, '/cart/checkout', '\\Controllers\\Shop\\CartController::CheckoutAction');

$app->map(AppService::RouteGetShipmentQuote, 'shipment/getQuote', 'Controllers\\ShipmentController::GetQuoteAction');

$app->map(AppService::RouteFrontendContact, '/contact', '\\Controllers\\HomeController::ContactAction');

$app->map(AppService::RouteApiSubdomains, '/api/subdomains', '\\Controllers\\Api\\SubdomainsController::IndexAction');
$app->map(AppService::RouteApiCreateSubdomain, '/api/subdomains/create/{store_id}', '\\Controllers\\Api\\SubdomainsController::CreateSubdomainAction');
$app->map(AppService::RouteRemoveSubdomain, '/api/subdomains/remove/{store_id}', '\\Controllers\\Api\\SubdomainsController::RemoveSubdomainAction');

$app->map(AppService::RouteApiStoresFillDefaultData, '/api/store/filldefaultdata/{store_id}', '\\Controllers\\Api\\StoresController::FillDefaultDataAction');

$app->map(AppService::RouteApiShippingCalculate, '/api/shipping/calculatecost', '\\Controllers\\Api\\ShippingController::CalculateCostAction');

$app->map(AppService::RouteApiOrdersCallback, '/api/orders/callback', '\\Controllers\\Api\\OrdersController:callbackAction');
