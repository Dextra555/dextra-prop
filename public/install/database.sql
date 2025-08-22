--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `country_code` varchar(3) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_ads`
--

CREATE TABLE `app_ads` (
  `id` int(11) UNSIGNED NOT NULL,
  `ads_name` varchar(255) DEFAULT NULL,
  `ads_info` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_ads`
--

INSERT INTO `app_ads` (`id`, `ads_name`, `ads_info`, `status`) VALUES
(1, 'Admob', '{\"publisher_id\":\"\",\"banner_on_off\":\"0\",\"banner_id\":\"\",\"interstitial_on_off\":\"0\",\"interstitial_id\":\"\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"0\",\"native_id\":\"\",\"native_position\":\"7\"}', 0),
(2, 'StartApp', '{\"publisher_id\":\"208651629\",\"banner_on_off\":\"0\",\"banner_id\":\"\",\"interstitial_on_off\":\"0\",\"interstitial_id\":\"\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"0\",\"native_id\":\"\",\"native_position\":\"7\"}', 0),
(3, 'Facebook', '{\"publisher_id\":\"\",\"banner_on_off\":\"0\",\"banner_id\":\"\",\"interstitial_on_off\":\"0\",\"interstitial_id\":\"\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"0\",\"native_id\":\"\",\"native_position\":\"7\"}', 0),
(4, 'AppLovins MAX', '{\"publisher_id\":\"\",\"banner_on_off\":\"0\",\"banner_id\":\"\",\"interstitial_on_off\":\"0\",\"interstitial_id\":\"\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"0\",\"native_id\":\"\",\"native_position\":\"7\"}', 0),
(5, 'Wortise', '{\"publisher_id\":\"a4e76baa-c4ce-4672-ba85-f2f7190bd19b\",\"banner_on_off\":\"1\",\"banner_id\":\"a2562302-14ce-476b-94d4-0c6431f1f927\",\"interstitial_on_off\":\"1\",\"interstitial_id\":\"ed6fc25c-9855-485e-9513-fed0d3acc528\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"1\",\"native_id\":\"cf65ed35-4765-4955-96fc-a33cf43d5340\",\"native_position\":\"7\"}', 1),
(6, 'Unity Ads', '{\"publisher_id\":\"\",\"banner_on_off\":\"0\",\"banner_id\":\"\",\"interstitial_on_off\":\"0\",\"interstitial_id\":\"\",\"interstitial_clicks\":\"5\"}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `status`) VALUES
(2, 'London, England', 1),
(3, 'New York, USA', 1),
(4, 'Paris, France', 1),
(5, 'Tokyo, Japan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_title` varchar(500) NOT NULL,
  `page_slug` varchar(500) NOT NULL,
  `page_content` text NOT NULL,
  `page_about_image` varchar(255) DEFAULT NULL,
  `page_about_text2` text DEFAULT NULL,
  `page_about_image2` varchar(255) DEFAULT NULL,
  `page_order` int(3) DEFAULT NULL,
  `page_position` varchar(255) NOT NULL DEFAULT 'Bottom',
  `page_contact_address` varchar(500) DEFAULT NULL,
  `page_contact_phone` varchar(255) DEFAULT NULL,
  `page_contact_email` varchar(255) DEFAULT NULL,
  `page_contact_map` varchar(500) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_title`, `page_slug`, `page_content`, `page_about_image`, `page_about_text2`, `page_about_image2`, `page_order`, `page_position`, `page_contact_address`, `page_contact_phone`, `page_contact_email`, `page_contact_map`, `status`) VALUES
(1, 'About Us', 'about-us', '<h2>Welcome to Viavi Real Estate</h2>\r\n<p>Welcome to Viavi Real Estate, where we turn houses into homes and dreams into reality. This Viavi Real Estate Portal is designed to make property management and browsing a breeze, offering a robust set of features tailored to the needs of today&rsquo;s real estate market.</p>\r\n<p>At Viavi Real Estate, our unwavering commitment lies in crafting unparalleled real estate journeys. Our seasoned professionals, armed with extensive market knowledge, walk alongside you through every phase of your property endeavor. We prioritize understanding your unique aspirations, tailoring our expertise to match your vision.</p>\r\n<p>Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.</p>', 'upload/placeholder_img.jpg', '<h2>Discover What Sets Our Real Estate Expertise Apart</h2>\r\n<p>Welcome to Viavi Real Estate, where we turn houses into homes and dreams into reality. This Viavi Real Estate Portal is designed to make property management and browsing a breeze, offering a robust set of features tailored to the needs of today&rsquo;s real estate market.</p>\r\n<p>At Viavi Real Estate, our unwavering commitment lies in crafting unparalleled real estate journeys. Our seasoned professionals, armed with extensive market knowledge, walk alongside you through every phase of your property endeavor. We prioritize understanding your unique aspirations, tailoring our expertise to match your vision.</p>\r\n<p>Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.</p>', 'upload/placeholder_img.jpg', 1, 'Top', NULL, NULL, NULL, NULL, 1),
(2, 'Contact Us', 'contact-us', '', NULL, NULL, NULL, 2, 'Top', '3rd Floor, Shyam Complex, Parivar Park, near Mayani Chowk, Rajkot, Gujarat', '+91 9874561233', 'info@example.com', '<iframe src=\\\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3692.061458662123!2d70.78399097404937!3d22.275661643790418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca4119fc5f3d%3A0x79efddff6062f51f!2sVIAVIWEB!5e0!3m2!1sen!2sin!4v1721715932201!5m2!1sen!2sin\\\" width=\\\"600\\\" height=\\\"450\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" loading=\\\"lazy\\\" referrerpolicy=\\\"no-referrer-when-downgrade\\\"></iframe>', 1),
(3, 'Privacy Policy', 'privacy-policy', '<h4><strong>Privacy Policy of&nbsp;<span class=\\\"highlight preview_company_name\\\">Company Name</span></strong></h4>\r\n<p><span class=\\\"highlight preview_company_name\\\">Company Name</span>&nbsp;operates the&nbsp;<span class=\\\"highlight preview_website_name\\\">Website Name</span>&nbsp;website, which provides the SERVICE.</p>\r\n<p>This page is used to inform website visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service, the&nbsp;<span class=\\\"highlight preview_website_name\\\">Website Name</span>&nbsp;website.</p>\r\n<p>If you choose to use our Service, then you agree to the collection and use of information in relation with this policy. The Personal Information that we collect are used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p>\r\n<p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at&nbsp;<span class=\\\"highlight preview_website_url\\\">Website URL</span>, unless otherwise defined in this Privacy Policy.</p>\r\n<h4><strong>Information Collection and Use</strong></h4>\r\n<p>For a better experience while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to your name, phone number, and postal address. The information that we collect will be used to contact or identify you.</p>\r\n<h4><strong>Log Data</strong></h4>\r\n<p>We want to inform you that whenever you visit our Service, we collect information that your browser sends to us that is called Log Data. This Log Data may include information such as your computer\\\'s Internet Protocol (&ldquo;IP&rdquo;) address, browser version, pages of our Service that you visit, the time and date of your visit, the time spent on those pages, and other statistics.</p>\r\n<h4><strong>Cookies</strong></h4>\r\n<p>Cookies are files with small amount of data that is commonly used an anonymous unique identifier. These are sent to your browser from the website that you visit and are stored on your computer\\\'s hard drive.</p>\r\n<p>Our website uses these &ldquo;cookies&rdquo; to collection information and to improve our Service. You have the option to either accept or refuse these cookies, and know when a cookie is being sent to your computer. If you choose to refuse our cookies, you may not be able to use some portions of our Service.</p>\r\n<h4><strong>Service Providers</strong></h4>\r\n<p>We may employ third-party companies and individuals due to the following reasons:</p>\r\n<ul>\r\n<li>To facilitate our Service</li>\r\n<li>To provide the Service on our behalf</li>\r\n<li>To perform Service-related services or</li>\r\n<li>To assist us in analyzing how our Service is used.</li>\r\n</ul>\r\n<p>We want to inform our Service users that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>\r\n<h4><strong>Security</strong></h4>\r\n<p>We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>\r\n<h4><strong>Links to Other Sites</strong></h4>\r\n<p>Our Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>\r\n<p>Children\\\'s Privacy</p>\r\n<p>Our Services do not address anyone under the age of 13. We do not knowingly collect personal identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.</p>\r\n<h4><strong>Changes to This Privacy Policy</strong></h4>\r\n<p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.</p>\r\n<h4><strong>Contact Us</strong></h4>\r\n<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>', NULL, NULL, NULL, 3, 'Bottom', NULL, NULL, NULL, NULL, 1),
(4, 'Terms Of Use', 'terms-of-use', '<p><strong>Use of this site is provided by Demos subject to the following Terms and Conditions:</strong><br />1. Your use constitutes acceptance of these Terms and Conditions as at the date of your first use of the site.<br />2. Demos reserves the rights to change these Terms and Conditions at any time by posting changes online. Your continued use of this site after changes are posted constitutes your acceptance of this agreement as modified.<br />3. You agree to use this site only for lawful purposes, and in a manner which does not infringe the rights, or restrict, or inhibit the use and enjoyment of the site by any third party.<br />4. This site and the information, names, images, pictures, logos regarding or relating to Demos are provided &ldquo;as is&rdquo; without any representation or endorsement made and without warranty of any kind whether express or implied. In no event will Demos be liable for any damages including, without limitation, indirect or consequential damages, or any damages whatsoever arising from the use or in connection with such use or loss of use of the site, whether in contract or in negligence.<br />5. Demos does not warrant that the functions contained in the material contained in this site will be uninterrupted or error free, that defects will be corrected, or that this site or the server that makes it available are free of viruses or bugs or represents the full functionality, accuracy and reliability of the materials.<br />6. Copyright restrictions: please refer to our Creative Commons license terms governing the use of material on this site.<br />7. Demos takes no responsibility for the content of external Internet Sites.<br />8. Any communication or material that you transmit to, or post on, any public area of the site including any data, questions, comments, suggestions, or the like, is, and will be treated as, non-confidential and non-proprietary information.<br />9. If there is any conflict between these Terms and Conditions and rules and/or specific terms of use appearing on this site relating to specific material then the latter shall prevail.<br />10. These terms and conditions shall be governed and construed in accordance with the laws of England and Wales. Any disputes shall be subject to the exclusive jurisdiction of the Courts of England and Wales.<br />11. If these Terms and Conditions are not accepted in full, the use of this site must be terminated immediately.</p>', NULL, NULL, NULL, 2, 'Bottom', NULL, NULL, NULL, NULL, 1),
(5, 'Delete Account Instruction', 'delete-account-instruction', '<p>We&rsquo;re sorry to see you go! Follow the steps below to manually delete your account. Please note that this action is irreversible, and all your data will be permanently removed.</p>\r\n<h3>Steps to Manually Delete Your Account:</h3>\r\n<ol>\r\n<li>\r\n<p><strong>Prepare Your Request</strong></p>\r\n<ul>\r\n<li>Ensure you have access to the email associated with your account.</li>\r\n<li>Have your username and any relevant account information ready.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Compose an Email</strong></p>\r\n<ul>\r\n<li>Open your email client.</li>\r\n<li>Create a new email addressed to our support team at <a rel=\\\"noreferrer\\\">support@example.com</a>.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Subject Line</strong></p>\r\n<ul>\r\n<li>Use a clear subject line such as \\\"Account Deletion Request\\\".</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Email Body</strong></p>\r\n<ul>\r\n<li>Include the following information in the body of the email:\r\n<ul>\r\n<li>Your full name.</li>\r\n<li>Your username.</li>\r\n<li>The email address associated with your account.</li>\r\n<li>A brief statement requesting the deletion of your account.</li>\r\n<li>(Optional) A reason for deleting your account.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Send the Email</strong></p>\r\n<ul>\r\n<li>Review the information for accuracy.</li>\r\n<li>Send the email to <a rel=\\\"noreferrer\\\">support@example.com</a>.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Wait for Confirmation</strong></p>\r\n<ul>\r\n<li>Our support team will process your request.</li>\r\n<li>You will receive a confirmation email once your account has been successfully deleted.</li>\r\n</ul>\r\n</li>\r\n</ol>\r\n<h3>Important Notes:</h3>\r\n<ul>\r\n<li><strong>Data Loss:</strong> All your data, including personal information, posts, and messages, will be permanently deleted and cannot be recovered.</li>\r\n<li><strong>Subscription Cancellation:</strong> Any active subscriptions will be automatically canceled. No refunds will be issued for unused portions of subscriptions.</li>\r\n<li><strong>Backup Your Data:</strong> If you wish to keep any data, make sure to download it before requesting account deletion.</li>\r\n</ul>\r\n<p>If you encounter any issues or need further assistance, please contact our support team at <a rel=\\\"noreferrer\\\">support@example.com</a>.</p>\r\n<p>Thank you for using our service!</p>', NULL, NULL, NULL, 4, 'Bottom', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway`
--

CREATE TABLE `payment_gateway` (
  `id` int(11) UNSIGNED NOT NULL,
  `gateway_name` varchar(255) NOT NULL,
  `gateway_short_info` varchar(255) DEFAULT NULL,
  `gateway_info` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_gateway`
--

INSERT INTO `payment_gateway` (`id`, `gateway_name`, `gateway_short_info`, `gateway_info`, `status`) VALUES
(1, 'Paypal', 'For international payment', '{\"mode\":\"sandbox\",\"paypal_client_id\":null,\"paypal_secret\":null}', 0),
(2, 'Stripe', 'For International Payment', '{\"stripe_secret_key\":null,\"stripe_publishable_key\":null}', 0),
(3, 'Razorpay', 'Pay with Wallets and UPI', '{\"razorpay_key\":null,\"razorpay_secret\":null}', 0),
(4, 'Paystack', 'Payments for Nigeria', '{\"paystack_secret_key\":null,\"paystack_public_key\":null}', 0),
(6, 'PayUMoney', 'Pay with Wallets and UPI', '{\"mode\":\"sandbox\",\"payu_merchant_id\":null,\"payu_key\":null,\"payu_salt\":null}', 0),
(8, 'Flutterwave', 'Payments for Africa', '{\"flutterwave_public_key\":null,\"flutterwave_secret_key\":null,\"flutterwave_encryption_key\":null}', 0),
(12, 'Bank Transfer', 'Manual Bank Transfer', '{\"banktransfer_info\":\"<p><strong>Account<\\/strong>: 2223330032299999<br \\/><strong>IFSC<\\/strong>: SBIN000123456<br \\/><strong>Bank Name<\\/strong>: SBI<br \\/><strong>Beneficiary Name<\\/strong>: John Deo<\\/p>\\r\\n<p><br \\/>Transfer the exact amount for the payment to be successful. Please make payment only in the account number mentioned above.<\\/p>\\r\\n<p>If you have any questions, you can contact customer support at any time.<\\/p>\"}', 1),
(13, 'Braintree', 'For International Payment', '{\"mode\":\"sandbox\",\"braintree_merchant_id\":null,\"braintree_public_key\":null,\"braintree_private_key\":null,\"braintree_merchant_account_id\":null}', 0),
(14, 'SSLCOMMERZ', 'Payment for Bangladesh', '{\"mode\":\"sandbox\",\"store_id\":\"viavi66f54bdb5c9cc\",\"store_password\":\"viavi66f54bdb5c9cc@ssl\"}', 1),
(15, 'CinetPay', 'CinetPay for West Africa and Central Africa', '{\"mode\":\"sandbox\",\"cinetpay_api_key\":\"903676224645c928b7f5758.24192977\",\"cinetpay_secret_key\":\"193562810164d367aebab324.18559187\",\"cinetpay_site_id\":\"608738\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_views`
--

CREATE TABLE `post_views` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `post_views` int(11) NOT NULL DEFAULT 0,
  `post_download` int(11) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `bathrooms` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `furnishing` varchar(255) DEFAULT NULL,
  `amenities` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `verified` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `floor_plan_image` varchar(255) DEFAULT NULL,
  `featured` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `user_id`, `type_id`, `location_id`, `title`, `slug`, `description`, `phone`, `address`, `latitude`, `longitude`, `purpose`, `bedrooms`, `bathrooms`, `area`, `furnishing`, `amenities`, `price`, `verified`, `image`, `floor_plan_image`, `featured`, `status`) VALUES
(2, 1, 3, NULL, 'Retro House', 'retro-house', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</p>', '9236541233', 'Zeleni put 21, Croatia', '22.261270', '70.806760', 'Rent', '2', '1', '60 m2', 'Semi-Furnished', 'Parking,Balcony,Computer,Internet', 300000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(6, 1, 1, NULL, '201 Folsom St Apt 18B', '201-folsom-st-apt-18b', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '98789456361', '201 Folsom St Apt 18B, San Francisco, CA 94105', '37.788700', '-122.392260', 'Rent', '2', '2', '620 m2', 'Furnished', 'Air conditioning,Computer,Internet,Gardan', 700000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(7, 1, 3, NULL, 'Semi-detached house', 'semi-detached-house', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</p>', '9236541233', 'KKV Hall, Rajkot', '22.285897', '70.772054', 'Sale', '1', '1', '60 m2', 'Furnished', 'Parking,Balcony,Computer,Internet', 200000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(8, 1, 5, NULL, '9 Square', '9-square', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '98789456361', 'Mayani Chock, Rajkot', '22.274074', '70.787436', 'Rent', '2', '2', '620 m2', 'Furnished', 'Air conditioning,Computer,Internet,Gardan', 500000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(9, 1, 1, NULL, 'Panchtatva 3', 'panchtatva-3', '<p>Swastik Panchtatva 3, is a sprawling luxury enclave of magnificent Apartments in Rajkot, elevating the contemporary lifestyle. These Residential Apartments in Rajkot offers you the kind of life that rejuvenates you, the one that inspires you to live life to the fullest</p>', '9898989898', 'Nana Mava Road, Rajkot', '22.278070', '70.765960', 'Rent', '3', '3', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 7800000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(11, 1, 1, NULL, 'Utsav Villa', 'utsav-villa', '<p>Quick overview of Utsav VillaUtsav villa is a bunglow project in one of the most developing area of rajkot.</p>', '9898989898', 'Ghanteshwer, Rajkot', '22.278070', '70.765960', 'Sale', '2', '3', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 500000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(12, 1, 1, NULL, 'The Hills', 'the-hills', '<p>The HillsThe Hills is a spacious 4-BHK with 1-Lifestyle Room apartment project</p>', '9898989898', 'Kalawad Road, Rajkot', '22.278070', '70.765960', 'Sale', '3', '4', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 400000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(13, 1, 1, NULL, 'Alpha Mangalam', 'alpha-mangalam', '<p>Alpha MangalamALFA MANGALAM&nbsp; is an residential project in rajkot that offers ideal family homes.</p>', '9898989898', 'Nana Mava Road, Rajkot', '22.278070', '70.765960', 'Rent', '2', '4', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 600000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(14, 1, 4, NULL, 'Ratnam Glorious', 'ratnam-glorious', '<p>Ratnam GloriousRATNAM GLORIOUS is a appartment project which is been developed near morbi road.</p>', '9898989898', 'Madhapar, Rajkot', '22.278070', '70.765960', 'Sale', '3', '5', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 8000000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(15, 1, 1, NULL, 'Akshar Heights', 'akshar-heights', '<p>Akshar HeightsAKSHAR HEIGHTS is an residential project in rajkot&nbsp;</p>', '9898989898', 'Nana Mava, Rajkot', '22.278070', '70.765960', 'Rent', '4', '6', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 10000000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(16, 1, 1, NULL, 'Nilkanth Apartment', 'nilkanth-apartment', '<p>Nilkanth ApartmentNILKANTH APARTMENT is an residential project in rajkot that offers ideal family homes</p>', '9898989898', '150 Feet Ring Road, Rajkot', '22.278070', '70.765960', 'Rent', '2', '3', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 4000000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(17, 1, 1, NULL, 'Nageshwar City', 'nageshwar-city', '<p>Nageshwar CityThe Biggest Project Of Jamnagar Road \\\"\\\"NAGESHWAR CITY\\\"\\\" Welcomes You. We Build \\\"\\\"Dream Home\\\"\\\" in Your Budget.</p>', '9898989898', 'Jamnagar Road, Rajkot', '22.278070', '70.765960', 'Sale', '2', '3', '1200 Sq-ft', 'Furnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 5000000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(18, 1, 2, NULL, 'Naveen Towers', 'naveen-towers', '<p>Naveen TowersNavin Towers is an unmatched Residential property located in,Rajkot.&nbsp;</p>', '9898989898', 'Bhagwatipara, Rajkot', '22.278070', '70.765960', 'Sale', '3', '4', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area', 800000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(19, 1, 1, NULL, 'Vertillas', 'vertillas', '<p>One of the most preferred destination for people working in IT/ITeSsector.Metro Connectivity to boost real estate demand.</p>', '9898989898', 'Kharadi, Pune', '22.278070', '70.765960', 'Rent', '3', '5', '1200 Sqft', 'Furnished', 'Lift, Security, Gymnasium, Grand Entrance lobby, CCTV Camera, Kids play area, Mediation area, Lawn', 11000000, 'YES', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(33, 1, 2, NULL, 'Flat/Apartment', 'flatapartment', '<p>Ghanteshwer is a mid segment locality situated in Rajkot. The pincode of this locality is 360006. This locality is near Dharam Nagar, 150 Feet Ring Road and Madhapar.&nbsp;</p>', '9898989898', 'Raiya Road, Rajkot', '22.278070', '70.765960', 'Rent', '3', '4', '1200 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance, lobby, CCTV Camera, Kids play area', 500000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(34, 1, 2, NULL, 'Madhav Flat', 'madhav-flat', '<p>Madhav Flat, Near Alap Green City, Raiya Road, Rajkot, Gujarat</p>', '9898989898', 'Near Alap Green City, Raiya Road, Rajkot', '22.278070', '70.765960', 'Sale', '2', '2', '950 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance, lobby, CCTV Camera, Kids play area', 550000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(35, 1, 2, 5, 'Adarsh Dream', 'adarsh-dream', '<p>Adarsh Dream 1 Jivraj Park Ambika Township Mavdi Rajkot, Mavdi, Rajkot, Gujarat</p>', '9898989898', 'Mavdi, Rajkot', '22.278070', '70.765960', 'Rent', '2', '3', '950 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance, lobby, CCTV Camera, Kids play area', 400000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(36, 1, 4, 2, 'Plot For Sale', 'plot-for-sale', '<p>It is close to mavdi main road fly over bridge on mavdi main road.</p>', '9898989898', 'Nana Mava Road, Rajkot', '22.278070', '70.765960', 'Rent', '1', '1', '1500 Sq-ft', 'Unfurnished', 'Security, Grand Entrance, lobby, CCTV Camera', 880000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(37, 1, 4, 3, 'Industries Plot', 'industries-plot', '<p>Plot no. 27, Street No. 6, Kalawad Road, Nandanvan societyRajkot, Gujarat, Kalawad Road, Rajkot, Gujarat</p>', '9898989898', 'Kalawad Road, Rajkot', '22.278070', '70.765960', 'Sale', '1', '1', '1200 Sqft', 'Unfurnished', '', 500000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(38, 1, 5, 3, 'Agricultural Land', 'agricultural-land', '<p>Jamnagar Road, Rajkot, Gujarat</p>', '9898989898', 'Jamnagar Road, Rajkot,', '22.278070', '70.765960', 'Sale', '2', '1', '1500 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance, lobby, CCTV Camera, Kids play area', 780000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(39, 1, 6, 5, 'Office Space', 'office-space', '<p>Ashish Complex, Sardarnagar Main Road, Sardar Nagar, Rajkot, Gujarat</p>', '9898989898', 'Raiya Road, Rajkot', '22.278070', '70.765960', 'Rent', '2', '1', '950 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance, lobby, CCTV Camera, Kids play area', 4000000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(40, 1, 6, 4, 'Office  in Mill Pura', 'office-in-mill-pura', '<p>150 Ring Road The SPire Building, Mill Pura, Rajkot, Gujarat</p>', '9898989898', 'Mill Pura, Rajkot', '22.278070', '70.765960', 'Sale', '1', '1', '950 Sq-ft', 'Unfurnished', 'Lift, Security, Gymnasium, Grand Entrance, lobby, CCTV Camera', 300000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(41, 1, 7, 2, '3 BHK Villa', '3-bhk-villa', '<div class=\\\"mb-ldp__more-dtl__list--value\\\">Madhav ashrey railnagar -2., Rail Nagar, Rajkot, Gujarat</div>\r\n<div class=\\\"mb-ldp__more-dtl__list--value\\\">Close to newly constructed AIIMS - Rajkot</div>', '9898989898', 'Rail Nagar, Rajkot', '22.278070', '70.765960', 'Sale', '3', '3', '1200 Sq-ft', 'Unfurnished', 'Security, Gymnasium, Grand Entrance, CCTV Camera', 500000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1),
(42, 1, 7, 3, '4 BHK Bungalow', '4-bhk-bungalow', '<div class=\\\"mb-ldp__more-dtl__list--value\\\">Dharti honda showroom</div>\r\n<div class=\\\"mb-ldp__more-dtl__list--value\\\">Unfurnished</div>\r\n<div class=\\\"mb-ldp__more-dtl__list--value\\\">Freehold</div>\r\n<div class=\\\"mb-ldp__more-dtl__list--label\\\">Overlooking</div>\r\n<div class=\\\"mb-ldp__more-dtl__list--value\\\">Main Road</div>\r\n<div class=\\\"mb-ldp__more-dtl__list--label\\\">Age of Construction</div>\r\n<div class=\\\"mb-ldp__more-dtl__list--value\\\">10 to 15 years</div>', '9898989898', 'Nana Mava Road, Rajkot', '22.278070', '70.765960', 'Rent', '2', '4', '1200 Sq-ft', 'Unfurnished', 'Security, Gymnasium, Grand Entrance, lobby, CCTV Camera, Kids play area', 9000000, 'NO', 'upload/placeholder_img.jpg', 'upload/placeholder_img.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_gallery`
--

CREATE TABLE `property_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_gallery`
--

INSERT INTO `property_gallery` (`id`, `post_id`, `image`) VALUES
(3, 6, 'upload/placeholder_img.jpg'),
(4, 6, 'upload/placeholder_img.jpg'),
(5, 8, 'upload/placeholder_img.jpg'),
(6, 8, 'upload/placeholder_img.jpg'),
(7, 2, 'upload/placeholder_img.jpg'),
(9, 9, 'upload/placeholder_img.jpg'),
(10, 9, 'upload/placeholder_img.jpg'),
(11, 9, 'upload/placeholder_img.jpg'),
(12, 9, 'upload/placeholder_img.jpg'),
(16, 11, 'upload/placeholder_img.jpg'),
(17, 11, 'upload/placeholder_img.jpg'),
(18, 12, 'upload/placeholder_img.jpg'),
(19, 12, 'upload/placeholder_img.jpg'),
(20, 12, 'upload/placeholder_img.jpg'),
(21, 13, 'upload/placeholder_img.jpg'),
(22, 13, 'upload/placeholder_img.jpg'),
(23, 13, 'upload/placeholder_img.jpg'),
(25, 14, 'upload/placeholder_img.jpg'),
(26, 14, 'upload/placeholder_img.jpg'),
(27, 15, 'upload/placeholder_img.jpg'),
(28, 15, 'upload/placeholder_img.jpg'),
(29, 15, 'upload/placeholder_img.jpg'),
(30, 15, 'upload/placeholder_img.jpg'),
(31, 16, 'upload/placeholder_img.jpg'),
(32, 16, 'upload/placeholder_img.jpg'),
(33, 16, 'upload/placeholder_img.jpg'),
(34, 16, 'upload/placeholder_img.jpg'),
(35, 17, 'upload/placeholder_img.jpg'),
(36, 17, 'upload/placeholder_img.jpg'),
(37, 17, 'upload/placeholder_img.jpg'),
(38, 17, 'upload/placeholder_img.jpg'),
(39, 17, 'upload/placeholder_img.jpg'),
(40, 18, 'upload/placeholder_img.jpg'),
(41, 18, 'upload/placeholder_img.jpg'),
(42, 18, 'upload/placeholder_img.jpg'),
(43, 19, 'upload/placeholder_img.jpg'),
(44, 19, 'upload/placeholder_img.jpg'),
(45, 19, 'upload/placeholder_img.jpg'),
(46, 19, 'upload/placeholder_img.jpg'),
(47, 19, 'upload/placeholder_img.jpg'),
(48, 7, 'upload/placeholder_img.jpg'),
(49, 7, 'upload/placeholder_img.jpg'),
(50, 7, 'upload/placeholder_img.jpg'),
(51, 7, 'upload/placeholder_img.jpg'),
(77, 33, 'upload/placeholder_img.jpg'),
(78, 33, 'upload/placeholder_img.jpg'),
(79, 33, 'upload/placeholder_img.jpg'),
(80, 34, 'upload/placeholder_img.jpg'),
(81, 34, 'upload/placeholder_img.jpg'),
(82, 35, 'upload/placeholder_img.jpg'),
(83, 35, 'upload/placeholder_img.jpg'),
(84, 36, 'upload/placeholder_img.jpg'),
(85, 36, 'upload/placeholder_img.jpg'),
(86, 37, 'upload/placeholder_img.jpg'),
(87, 37, 'upload/placeholder_img.jpg'),
(88, 37, 'upload/placeholder_img.jpg'),
(89, 37, 'upload/placeholder_img.jpg'),
(90, 38, 'upload/placeholder_img.jpg'),
(91, 38, 'upload/placeholder_img.jpg'),
(92, 39, 'upload/placeholder_img.jpg'),
(93, 39, 'upload/placeholder_img.jpg'),
(94, 40, 'upload/placeholder_img.jpg'),
(95, 40, 'upload/placeholder_img.jpg'),
(96, 41, 'upload/placeholder_img.jpg'),
(97, 41, 'upload/placeholder_img.jpg'),
(98, 42, 'upload/placeholder_img.jpg'),
(99, 42, 'upload/placeholder_img.jpg'),
(100, 42, 'upload/placeholder_img.jpg'),
(101, 42, 'upload/placeholder_img.jpg'),
(102, 42, 'upload/placeholder_img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_description` varchar(255) DEFAULT NULL,
  `site_keywords` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `site_email` varchar(255) NOT NULL,
  `site_header_code` text DEFAULT NULL,
  `site_footer_code` text DEFAULT NULL,
  `site_copyright` varchar(255) DEFAULT NULL,
  `styling` varchar(255) NOT NULL DEFAULT 'stylesheet_one',
  `time_zone` varchar(255) NOT NULL DEFAULT 'UTC',
  `default_language` varchar(255) NOT NULL DEFAULT 'en',
  `currency_code` varchar(255) NOT NULL DEFAULT 'USD',
  `admin_logo` varchar(255) DEFAULT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_company` varchar(255) DEFAULT NULL,
  `app_website` varchar(255) DEFAULT NULL,
  `app_contact` varchar(255) DEFAULT NULL,
  `app_version` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_email` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `smtp_encryption` varchar(255) DEFAULT NULL,
  `google_login` varchar(255) NOT NULL DEFAULT 'false',
  `google_client_id` varchar(255) DEFAULT NULL,
  `google_client_secret` varchar(255) DEFAULT NULL,
  `google_redirect` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_address` varchar(500) DEFAULT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `onesignal_app_id` varchar(255) DEFAULT NULL,
  `onesignal_rest_key` varchar(255) DEFAULT NULL,
  `app_update_hide_show` varchar(255) NOT NULL DEFAULT 'true',
  `app_update_version_code` varchar(255) DEFAULT NULL,
  `app_update_desc` varchar(255) DEFAULT NULL,
  `app_update_link` varchar(255) DEFAULT NULL,
  `app_update_cancel_option` varchar(255) NOT NULL DEFAULT 'true',
  `pagination_limit` int(3) NOT NULL DEFAULT 10,
  `latest_limit` int(3) NOT NULL DEFAULT 10,
  `envato_buyer_name` varchar(255) DEFAULT NULL,
  `envato_purchase_code` varchar(255) DEFAULT NULL,
  `app_package_name` varchar(255) DEFAULT NULL,
  `recaptcha_site_key` varchar(255) DEFAULT NULL,
  `recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `recaptcha_on_login` int(1) NOT NULL DEFAULT 0,
  `recaptcha_on_signup` int(1) NOT NULL DEFAULT 0,
  `recaptcha_on_forgot_pass` int(1) NOT NULL DEFAULT 0,
  `recaptcha_on_contact_us` int(1) NOT NULL DEFAULT 0,
  `gdpr_cookie_on_off` int(1) NOT NULL DEFAULT 1,
  `gdpr_cookie_title` varchar(500) DEFAULT NULL,
  `gdpr_cookie_text` text DEFAULT NULL,
  `gdpr_cookie_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_description`, `site_keywords`, `site_logo`, `site_favicon`, `site_email`, `site_header_code`, `site_footer_code`, `site_copyright`, `styling`, `time_zone`, `default_language`, `currency_code`, `admin_logo`, `app_name`, `app_email`, `app_logo`, `app_company`, `app_website`, `app_contact`, `app_version`, `smtp_host`, `smtp_port`, `smtp_email`, `smtp_password`, `smtp_encryption`, `google_login`, `google_client_id`, `google_client_secret`, `google_redirect`, `contact_email`, `contact_phone`, `contact_address`, `facebook_link`, `twitter_link`, `instagram_link`, `youtube_link`, `onesignal_app_id`, `onesignal_rest_key`, `app_update_hide_show`, `app_update_version_code`, `app_update_desc`, `app_update_link`, `app_update_cancel_option`, `pagination_limit`, `latest_limit`, `envato_buyer_name`, `envato_purchase_code`, `app_package_name`, `recaptcha_site_key`, `recaptcha_secret_key`, `recaptcha_on_login`, `recaptcha_on_signup`, `recaptcha_on_forgot_pass`, `recaptcha_on_contact_us`, `gdpr_cookie_on_off`, `gdpr_cookie_title`, `gdpr_cookie_text`, `gdpr_cookie_url`) VALUES
(1, 'Viavi Real Estate Script', 'Viavi Real estate made simple is lightning fast and light weight PHP script. Viavi Real estate agents work with property buyers or sellers and help them to navigate a complex nature of a property market.', 'apartment for rent, bootstrap, commercial, estate listings, google maps, house, land, property agent, property script, real estate php script, rental listings, sale, Viavi real estate app', 'upload/site_logo.png', 'upload/favicon.png', 'info@example.com', '', '', 'Copyright © 2024 www.viaviweb.com All Rights Reserved.', 'stylesheet_one', 'Asia/Kolkata', 'en', 'USD', 'upload/real_estate_app_logo.png', 'Real Estate', 'info@viavilab.com', 'upload/app_icon2.png', 'Viavi Webtech', 'www.viaviweb.com', '+91 9227777522', '1.0.0', NULL, '465', NULL, NULL, 'SSL', '0', NULL, NULL, '', 'info@example.com', '+91 9876541233', '3rd Floor, Shyam Complex, Parivar Park, near Mayani Chowk, Rajkot, Gujarat', 'https://facebook.com/viaviweb', 'https://twitter.com/viaviwebtech', 'https://instagram.com/viaviwebtech', 'https://youtube.com/viaviwebtech', NULL, NULL, 'false', '1', 'Please update new app', 'https://google.com', 'true', 10, 10, NULL, NULL, 'com.app.realestateapp', NULL, NULL, 0, 0, 0, 0, 1, 'This Website Is Using Cookies', 'We use them to give you the best experience. If you continue using our website, we\\\'ll assume that you are happy to receive all cookies on this website.', '#');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE `subscription_plan` (
  `id` int(11) UNSIGNED NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_days` int(11) NOT NULL,
  `plan_duration` varchar(255) NOT NULL,
  `plan_duration_type` varchar(255) NOT NULL,
  `plan_price` decimal(11,2) NOT NULL,
  `plan_property_limit` int(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`id`, `plan_name`, `plan_days`, `plan_duration`, `plan_duration_type`, `plan_price`, `plan_property_limit`, `status`) VALUES
(1, 'Free Plan', 1, '1', '1', 0.00, 1, 1),
(2, 'Basic Plan', 7, '7', '1', 10.00, 5, 1),
(3, 'Premium Plan', 30, '1', '30', 50.00, 10, 1),
(4, 'Platinum Plan', 365, '1', '365', 99.00, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `gateway` varchar(255) NOT NULL,
  `payment_amount` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_slug` varchar(255) NOT NULL,
  `type_image` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type_name`, `type_slug`, `type_image`, `status`) VALUES
(1, 'Apartment', 'apartment', 'upload/types/apartment.png', 1),
(2, 'Commercial', 'commercial', 'upload/types/commercial.png', 1),
(3, 'House', 'house', 'upload/types/house.png', 1),
(4, 'Industrial', 'industrial', 'upload/types/industrial.png', 1),
(5, 'Land', 'land', 'upload/types/land.png', 1),
(6, 'Office', 'office', 'upload/types/office.png', 1),
(7, 'Residential', 'residential', 'upload/types/residential.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `usertype` varchar(255) DEFAULT 'User',
  `social_login_type` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `plan_id` int(4) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `exp_date` int(11) DEFAULT NULL,
  `plan_amount` float(11,2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `confirmation_code` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `session_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `social_login_type`, `google_id`, `facebook_id`, `name`, `email`, `password`, `phone`, `user_image`, `plan_id`, `start_date`, `exp_date`, `plan_amount`, `status`, `confirmation_code`, `remember_token`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, 'Viavi Webtech', 'admin@admin.com', '$2y$12$2sNGts3XlhqNNMEvSOf4b.JGb6F8BZDcG12e.KjZI1SZ6IKWJ1D2C', '9227777522', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'guGeBrzDfXhAKfImcEKYHx7rAZQJ2hfJzFoo6uprF6n0tEcM5kY8QEofTELG', 'iXL5Efee1FhfiXQzxPTe2PzEfFqU3seM3b6TzvU7', '2020-03-10 02:46:45', '2024-07-23 16:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `web_banner_ads`
--

CREATE TABLE `web_banner_ads` (
  `id` int(11) UNSIGNED NOT NULL,
  `home_top` text DEFAULT NULL,
  `home_bottom` text DEFAULT NULL,
  `list_top` text DEFAULT NULL,
  `list_bottom` text DEFAULT NULL,
  `details_top` text DEFAULT NULL,
  `details_bottom` text DEFAULT NULL,
  `other_page_top` text DEFAULT NULL,
  `other_page_bottom` text DEFAULT NULL,
  `sidebar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `web_banner_ads`
--

INSERT INTO `web_banner_ads` (`id`, `home_top`, `home_bottom`, `list_top`, `list_bottom`, `details_top`, `details_bottom`, `other_page_top`, `other_page_bottom`, `sidebar`) VALUES
(1, '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_ads`
--
ALTER TABLE `app_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_property_user_id_type_id_location_id_status` (`user_id`,`type_id`,`location_id`,`status`);

--
-- Indexes for table `property_gallery`
--
ALTER TABLE `property_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_gallery_post_id` (`post_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_transaction_user_id` (`user_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_banner_ads`
--
ALTER TABLE `web_banner_ads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_ads`
--
ALTER TABLE `app_ads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_views`
--
ALTER TABLE `post_views`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `property_gallery`
--
ALTER TABLE `property_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_banner_ads`
--
ALTER TABLE `web_banner_ads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
 
