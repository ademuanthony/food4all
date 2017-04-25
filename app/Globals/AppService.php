<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/5/2016
 * Time: 9:35 AM
 */

namespace Globals;


class AppService
{
    const REFERRAL_EARNING_AMOUNT = 20;
    const EARNING_EVENT_REFERRAL = 'referral';
    const RouteHome = 'home';
    const RouteAbout = 'about_us';
    const CompensationPlan = 'compensation_plan';
    const Gallery = 'gallery';
    const Faq = 'faq';
    const HowItWorks = 'how_it_works';
    const Support = 'support';
    const Contact = 'contact';

    const RouteBackendDashboard = 'dashboard';

    const RouteBackendCategories = 'categories';
    const RouteBackendAddCategory = 'add_category';
    const RouteBackendManageCategory = 'manage_category';
    const RouteBackendDeleteCategory = 'delete_category';

    const RouteBackendProducts = 'products';
    const RouteBackendAddProduct = 'add_product';
    const RouteBackendManageProduct = 'manage_product';
    const RouteBackendDeleteProduct = 'delete_product';

    const RouteBackendOrders = 'orders';

    const RouteBackendCustomers = 'customers';

    const RouteBackendSettings = 'settings';
    const RouteBackendSettingsSaveInformation = 'settings_save_information';
    const RouteBackendSettingChangeTheme = 'settings_change_theme';
    const RouteBackendSettingsAddSliders = 'settings_add_slider';
    const RouteBackendSettingDeleteSlider = 'settings_delete_slider';

    const BackendCampaigns = 'backend_campaigns';
    const BackendCampaignAdd = 'backend_campaigns_add';
    const BackendCampaignDelete = 'backend_campaign_delete';
    const BackendCampaignDetails = 'backend_campaign_details';

    const FrontendCampaigns = 'frontend_campaigns';
    const FrontendCampaignsShare = 'frontend_campaigns_share';

    //API
    const API_Member = 'api_member';

    //MLM
    const Login = 'login';
    const Register = 'register';
    const RegisterStep2 = 'register_step2';
    const Logout = 'logout';
    const ForgotPassword = 'forgot_password';
    const AddAccount = 'add_account';

    const Pin = 'pin';
    const BuyPin = 'buy_pin';
    const BuyFood = 'buy_food';


    const Payment_Pay = 'payment_pay';
    const Payment_Success = 'payment_success';
    const Payment_Failed = 'payment_failed';
    const Payment_Pending = 'payment_pending';
    const Payment_Cancelled = 'payment_cancelled';

    const Profile = 'profile';
    const UPDATE_PERSONAL_INFORMATION = 'update_personal_information';
    const UPDATE_CONTACT_INFORMATION = 'update_contact_information';
    const UPDATE_NEXT_OF_KIN = 'update_next_of_kin';
    const UPDATE_BANK_DETAIL = 'update_bank_detail';
    const UPDATE_ADDRESS = 'update_address';
    const PASSWORD_RESET = 'password_reset';
    const PIN_RESET = 'pin_reset';

    const Shop = 'shop';
    const ControlPanel = 'cpanel';
    const Genealogy = 'genealogy';
    const Genealogy_My_Growth = 'genealy_my_growth';
    const Genealogy_My_Down_Line_tree = 'genealogy_my_down_line_tree';
    const Genealogy_My_Down_Line_List = 'genealogy_my_down_line_list';
    const Genealogy_Direct_Down_Line = 'genealogy_direct_down_line';
    const Earnings = 'earnings';
    const GenealogySearch = 'genealogy_search';
    
    const Notifications = 'notifications';
    const ReadNotification = 'read_notification';


    const Transactions = 'transactions';
    const FundTransfers = 'transactions_fund_transfers';
    const SendMoney = 'transactions_send_money';
    const Transaction_Histories = 'transactions_histories';



    const RouteFrontendCategories = 'frontend_categories';
    const RouteFrontendViewCategory = 'frontend_viewCategory';

    const RouteFrontendProducts = 'frontend_products';
    const RouteFrontendViewProduct = 'frontend_view_product';

    const RouteCart = 'cart';
    const RouteAddToCart = 'add_to_cart';
    const RouteIncreaseCartItem = 'increase_cart_item_quantity';
    const RouteReduceCartItem = 'reduce_cart_item_quantity';
    const RouteRemoveFromCart = 'remove_from_cart';
    const RouteCheckout = 'checkout';

    const RouteGetShipmentQuote = 'get_shipment_quote';

    const RouteFrontendContact = 'frontend_contact';


    const RouteApiSubdomains = 'subdomains';
    const RouteApiCreateSubdomain = 'create_subdomain';
    const RouteRemoveSubdomain = 'remove_subdomain';

    const RouteApiStoresFillDefaultData = 'api_stores_fill_default_data';

    const RouteApiShippingCalculate = 'shipping_calculate';

    const RouteApiOrdersCallback = 'orders_callback';
}