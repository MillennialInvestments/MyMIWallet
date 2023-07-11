<?php 
$userAccount                        = $_SESSION['allSessionData']['userAccount'];
$cuID                               = $userAccount['cuID'];
?>
<style>
b>span {font-weight: bold; padding: 3rem 0 0rem !important;}
.text-header {margin-bottom: 0px !important;padding-top:1rem;}
</style>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title">MyMI Wallet, LLC Affiliate Program Agreement</h1>
                        <h2 class="card-subtitle mb-3 myfs-sm">Last Modified: May 20, 2023</h2>
                        <a href="<?php echo site_url('/Referral-Program/Apply'); ?>">Return to Referral Program</a>							
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <!-- NEW CONFIG -->
                <div class="row">
                    <div class="col px-3">
                        <h3 class="dark-text myfs-md"><strong>PLEASE READ THIS AFFILIATE PROGRAM AGREEMENT CAREFULLY.</strong></h3>
                        <p class="dark-text">
                            This is a contract between you (the “Affiliate”) and us (“My Millennial Investments, LLC”, doing business as "MyMI Wallet, LLC."). 
                            It describes how we will work together and other aspects of our business relationship. 
                            It is a legal document so some of the language is necessarily “legalese”, but we have tried to make it as readable as possible.
                        </p>
                        <p class="dark-text">
                            The Affiliate Program Agreement applies to your participation in our Affiliate Program (the “Affiliate Program”). 
                            These terms are so important that we cannot have you participate in our Affiliate Program unless you agree to them.
                        </p>
                        <p class="dark-text">
                            We periodically update these terms. We might also choose to
                            replace these terms in their entirety if, for example, the Affiliate Program
                            changes, ends, or becomes part of an existing program, including our partner
                            programs. If we update or replace the terms, we will let you know via
                            electronic means, which may include an in-app notification or by email. If you
                            don’t agree to the update or replacement, you can choose to terminate as we
                            describe below.
                        </p>
                        <h4 class="card-title py-3">Definitions</h4>
                        <p class="dark-text">
                            “MyMI Wallet, LLC.” (pronounced: My M I Wal~let, L L C.) means a company owned, operated, or controlled by My Millennial Investments, LLC and will be referred to as "MyMI" or "MyMI Wallet".
                        </p>
                        <p class="dark-text">
                            “Affiliate Program” means our Affiliate Program as described in this Agreement.
                        </p>
                        <p class="dark-text">
                            “Affiliate Lead” means a member prospect who clicks on the Affiliate Link that we have made available to you via the Affiliate Tool.
                        </p>
                        <p class="dark-text">
                            “Affiliate Link” means the unique tracking link you place on your site or promote through other channels.
                        </p>
                        <p class="dark-text">
                            “Affiliate Policies” means the policies applicable to affiliates that we may make available to you from time to time.
                        </p>
                        <p class="dark-text">
                            “Affiliate Tool” means the tool that we make available to you upon your acceptance into the Affiliate Program and for you to use to participate in the Affiliate Program.
                        </p>
                        <p class="dark-text">
                            "Agreement" means this Affiliate Program Agreement and all materials referred to or linked to here.
                        </p>
                        <p class="dark-text">
                            “Commission” means an amount described on the Program Policies Page for each Member Transaction.
                        </p>
                        <p class="dark-text">
                            “Customer” means the authorized user of the MyMI Wallet Products who has purchased the MyMI Wallet products after being an Affiliate Lead.
                        </p>
                        <p class="dark-text">
                            “Member Transactions” means those transactions by Affiliate Leads that are eligible for Commission according to the ‘Member Transactions’ section of this Agreement.
                        </p>
                        <p class="dark-text">
                            "Member Data" means all information that Member submits or collects via the MyMI Wallet Products and all materials that Member provides or posts, uploads, inputs, or submits for public display through the MyMI Wallet Products.
                        </p>
                        <p class="dark-text">
                            "MyMI Wallet Content" means all information, data, text, messages, software, sound, music, video, photographs, graphics, images, and tags that we incorporate into our services.
                        </p>
                        <p class="dark-text">
                            “MyMI Wallet Products” means both the Subscription Service and Other Products.
                        </p>
                        <p class="dark-text">
                            “Program Policies Page” means the landing page: <a href="<?php echo site_url('/Referral-Program/Apply' . $cuID); ?>"><span><?php echo site_url('/Referral-Program/Apply' . $cuID); ?></span></a> where we will provide all the up-to-date guidelines and policies for the Affiliate Program.
                        </p>
                        <p class="dark-text">
                            “Other Products” means those products and services that we offer, which are not included in the Subscription Service (as detailed below); and, for the purposes of this Agreement, Other Products include all of our marketing software, legacy sales, and marketing products, and any implementation, customization, training, consulting, additional support or other professional services, or fees for third-party products or services.
                        </p>
                        <p class="dark-text">
                            “Subscription Service” means our web-based sales software that is subscribed to, developed, operated, and maintained by us, accessible via <a href="<?php echo site_url('/'); ?>"><span><?php echo site_url('/'); ?></span></a> or another designated URL, and add-on products to our sales software. 
                            For the purposes of this Agreement, the Subscription Service does not include our legacy sales products, any implementation, customization, training, consulting, additional support, or other professional services, or fees for third-party products or services.
                        </p>
                        <p class="dark-text">
                            "We", "us", “our”, and “MyMI Wallet” means MyMI Wallet, LLC.
                        </p>
                        <p class="dark-text">
                            “You” and “Affiliate” means the party, other than MyMI Wallet, entering into this Agreement and participating in the Affiliate Program.
                        </p>
                        <h4 class="card-title py-3">Non-Exclusivity</h4>
                        <p class="dark-text">
                            This Agreement does not create an exclusive agreement between you and us. 
                            Both you and we will have the right to recommend similar products and services of third parties and to work with other parties in connection with the design, sale, installation, implementation, and use of similar services and products of third parties.
                        </p>
                        <h4 class="card-title py-3">Affiliate Acceptance</h4>
                        <p class="dark-text">
                            Once you complete an application to become an Affiliate, we will review your application and notify you whether you have been accepted to participate in the Affiliate Program, or not.  
                            Before we accept an application, we may want to review your application with you, so we may reach out to you for more information. 
                            We may require that you complete certain requirements or certification(s) before we accept your application. 
                            If we do not notify you that you are accepted to participate in the Affiliate Program within thirty (30) days of your application, your application is considered to be rejected.
                        </p>
                        <p class="dark-text">
                            If you are accepted to participate in the Affiliate Program, then upon notification of acceptance, the terms and conditions of this Agreement shall apply in full force and effect, until terminated, according to the terms set forth below.  
                            Further, you will need to complete any enrollment criteria set out in the Program Policies Page, if applicable. 
                            Failure to complete any enrollment criteria within thirty (30) days of your acceptance will result in the immediate termination of this Agreement and you will no longer be able to participate in the Affiliate Program.
                        </p>
                        <p class="dark-text">
                            Your acceptance and participation in the Affiliate Program do not mean that you will be accepted into any of our MyMI Wallet Partner Programs, including our Sales Referral Partner Program. 
                            To participate in these programs, you will need to apply by the relevant application procedure.
                        </p>
                        <p class="dark-text">
                            You will comply with the terms and conditions of this Agreement and any applicable Program Policies at all times.
                        </p>
                        <h4 class="card-title py-3">Member Transactions</h4>
                        <p class="dark-text">
                            <strong>1. Affiliate Program Limits.</strong> Each accepted Affiliate Lead will expire according to the information provided on the Program Policy Page. 
                            From the date, the Affiliate Lead clicked on the Affiliate Link that was made available by you. 
                            We will pay you Commission for each new Member who completes a Member Transaction after clicking on an Affiliate Lead made available by you, provided that you remain eligible to receive Commission according to the terms of this Agreement.
                            The start of the Customer’s subscription is determined by the date of the first purchase of the Subscription Service by the Member and you will receive a Commission Payment for that Member Transaction only.  
                        </p>
                        <p class="dark-text">
                            <strong>2. Eligibility.</strong> To be eligible for Commission (i) an Affiliate Lead must be accepted and valid per the ‘Acceptance and Validity’ section, (ii) a Member Transaction must have occurred (iii) a Member must remain a member thirty (30) days to be eligible for a Commission. 
                            For example, a Member who purchases on the 15th of March must remain a member until the 15th of April to be eligible for a Commission. 
                            All transactions must occur on a mymillennialinvestments.com domain. 
                            You are not eligible to receive Commission or any other compensation from us based on transactions for Other Products or if: 
                                (i) such compensation is disallowed or limited by federal, state or local law or regulation in the United States or the laws or regulations of your jurisdiction; 
                                (ii) the applicable Member objects to or prohibits such compensation or excludes such compensation from its payments to us or MyMI Wallet Affiliates;
                                (iii) the Member has paid or will pay such commissions, referral fees, or other compensation directly to you, 
                                (iv) the Commission payment has been obtained by fraudulent means, misuse of the Affiliate Link, in violation of any Affiliate Program Policies that we make available to you, misuse of the Affiliate Tool or by any other means that we deem to breach the spirit of the Affiliate Program, or 
                                (v) the Member participates in any of our partner programs, including our Sales Referral Partner Program and is eligible to receive commission in relation to the Member Transaction under any of these programs. 
                            If at any point you are eligible to receive a revenue share payment under the Sales Referral Partner Program that payment amount will not change based on your participation in the Affiliate Program. 
                            For example, you will not be able to receive the Commission set out in this Agreement on any Partner Transaction that was completed whilst participating as a partner in the Sales Referral Partner Program (as defined in the Sales Referral Partner Program Agreement). 
                            In competitive situations with other affiliates, we may elect to provide the Commission to the affiliate that we deem to be the most eligible for Commission, at our discretion. 
                            We may discontinue Commission payments should any of the eligibility criteria outlined in this subsection fail to be met at any time. 
                            Purchases via MyMI Wallet for Startups or MyMI Wallet for Entrepreneurs are not eligible for Commission payments.
                        </p>
                        <p class="dark-text">
                            <strong>3. Acceptance and Validity.</strong> You will only be eligible for a Commission payment for any Member Transactions that are derived from Affiliate Leads generated by the Affiliate Link that we make
                            available to you and are accepted by MyMI Wallet. 
                            An Affiliate Lead will be considered valid and accepted if, in our reasonable determination: 
                                (i) it is a new potential member of ours, and 
                                (ii) is not, at the time of submission or sixty (60) days prior, one of our pre-existing customers, or involved in our active sales process. 
                            Notwithstanding the foregoing, we may choose not to accept an Affiliate Lead at our reasonable discretion. 
                            If an Affiliate Lead does not purchase the Subscription Service within the period described on the Program Policies Page of their first click on the Affiliate Link, you will not be eligible for a Commission payment, even if the Affiliate Lead decides to purchase after the period has expired.
                            An Affiliate Lead is not considered valid if its first click on the Affiliate Link is after this Agreement has expired or terminated. 
                            Engagement with Prospects.  
                            
                            Once we have received the Affiliate Lead information, we may elect to engage with the prospect directly, regardless of whether or not the Affiliate Lead is valid. 
                            If an Affiliate Lead is not valid then we may choose to maintain it in our database and we may choose to engage with such Affiliate Lead. 
                            Any engagement between MyMI Wallet and an Affiliate Lead will be at Millennial Investment’s discretion.
                        </p>
                        <p class="dark-text">
                            <strong>4. Commission and Payment.</strong> Requirements for Payment; Forfeiture. 
                            To receive payment under this Agreement, you must have: 
                            (i) agreed to the terms of this Agreement (generally completed through the Affiliate Tool); 
                            (ii) completed all steps necessary to create your account in the Affiliate Tool following our directions, 
                            (iii) have a valid and up-to-date PayPal account and updated the Affiliate Tool by connecting the account 
                            (iv) completed any and all required tax documentation for MyMI Wallet to process any payments that may be owed to you.
                        </p>
                        <p class="dark-text">
                            <strong>5. Forfeited Transactions.</strong> Notwithstanding the foregoing or anything to the contrary in this Agreement, if any of the requirements outlined in section 4(a)(i-iv) remain outstanding for six (6) months immediately following the close of a Member Transaction, then your right to receive Commission arising from all Member Transactions with the associated Member will be forever forfeited (each, a “Forfeited Transaction”). 
                            We will have no obligation to pay you Commission associated with a Forfeited Transaction. 
                            Once you comply with all of the requirements in section 5(a)(i-iv), then you will be eligible to receive Commission on Member Transactions, as long as these Member Transactions do not involve the same Member associated with a Forfeited Transaction.
                        </p>
                        <p class="dark-text">
                            <strong>6. Commission Payment.</strong> We, or a MyMI Wallet Affiliate, will pay the Commission amount due to you within forty-five (45) days after the end of each fiscal quarter for any Commission amounts that you become eligible for according to the Eligibility section above. We will determine the currency in which we pay the Commission, as well as the applicable conversion rate. We will not pay more than one Commission payment or other similar referral fees on any given Member Transaction (unless we choose to at our discretion). Taxes. You are responsible for the payment of all taxes applicable to the Commission. All amounts payable by us to you are subject to offset by us against any amounts owed by you to us. Commission Amounts. We reserve the right to alter or change the Commission amount. We will post all information regarding the Commission amount on the Program Policies Page.
                        </p>
                        <h4 class="text-header pb-3">Training and Support</h4>
                        <ol class="dark-text pb-3">
                            <li>
                                <strong>7. Affiliate Training and Support.</strong> We may make available to you, without charge, various webinars and other resources made available as part of our Affiliate Program. If we make such resources available to you, you will encourage your sales representatives and/or other relevant personnel to participate in training and/or other certifications as we recommend and may make available to you from time to time. We may change or discontinue any or all parts of the Affiliate Program benefits or offerings at any time without notice.
                            </li>
                        </ol>
                        <h4 class="text-header pb-3">Trademarks</h4>
                        <p class="dark-text">
                            You grant to us a nonexclusive, nontransferable, royalty-free right to use and display your trademarks, service marks, and logos (“Affiliate Marks”) in connection with the Affiliate Program and this Agreement.
                        </p>
                        <p class="dark-text">
                            During the term of this Agreement, in the event that we make our trademark available to you within the Affiliate Tool, you may use our trademark as long as you follow the usage requirements in this section. You must: (i) only use the images of our trademark that we make available to you, without altering them in any way; (ii) only use our trademarks in connection with the Affiliate Program and this Agreement; and (iii) immediately comply if we request that you discontinue use. You must not: (i) use our trademark in a misleading or disparaging way; (ii) use our trademark in a way that implies we endorse, sponsor or approve of your services or products; or (iii) use our trademark in violation of applicable law or in connection with an obscene, indecent, or unlawful topic or material.
                        </p>
                        <h5 class="card-title">Proprietary Rights.</h5>
                        <p class="dark-text">
                            <strong>8. Millennial Investment’s Proprietary Rights.</strong> No license to any software is granted by this Agreement. The MyMI Wallet Products are protected by intellectual property laws. The MyMI Wallet Products belong to and are the property of us or our licensors (if any). We retain all ownership rights in the MyMI Wallet Products. You agree not to copy, rent, lease, sell, distribute, or create derivative works based on the MyMI Wallet Content, or the MyMI Wallet Products in whole or in part, by any means, except as expressly authorized in writing by us. MyMI Wallet, the Sprocket Design, the MyMI Wallet logos, and other marks that we use from time to time are our trademarks and you may not use them without our prior written permission, except as otherwise set forth in this Agreement.
                        </p>
                        <p class="dark-text">
                            <strong>9. Feedback/Suggestions</strong> We encourage all customers, affiliates, and partners to comment on the MyMI Wallet Products, provide suggestions for improving them and vote on suggestions they like. You agree that all such comments and suggestions will be non-confidential and that we own all rights to use and incorporate them into the MyMI Wallet Products, without payment to you.
                        </p>
                        <p class="dark-text">
                            <strong>10. Customer’s Proprietary Rights.</strong> As between you and Member, Member retains the right to access and use the Member portal associated with the MyMI Wallet Products. For the avoidance of doubt, the Member will own and retain all rights to the Member Data.
                        </p>
                        <h4 class="text-header pb-3">Confidentiality</h4>
                        <p class="dark-text">
                            As used herein, “Confidential Information” means all confidential information disclosed by a party ("Disclosing Party") to the other party (“Receiving Party”), (i) whether orally or in writing, that is designated as confidential, and (ii) MyMI Wallet Member and prospect information, whether or not otherwise designated as confidential. Confidential Information does not include any information that (i) is or becomes generally known to the public without breach of any obligation owed to the Disclosing Party or (ii) was known to the Receiving Party prior to its disclosure by the Disclosing Party without breach of any obligation owed to the Disclosing Party. The Receiving Party shall: (i) protect the confidentiality of the Confidential Information of the Disclosing Party using the same degree of care that it uses with its own confidential information, but in no event less than reasonable care, (ii) not use any Confidential Information of the Disclosing Party for any purpose outside the scope of this Agreement, (iii) not disclose Confidential Information of the Disclosing Party to any third party, and (iv) limit access to Confidential Information of the Disclosing Party to its employees, contractors, and agents. The Receiving Party may disclose Confidential Information of the Disclosing Party if required to do so under any federal, state, or local law, statute, rule or regulation, subpoena, or legal process.
                        </p>
                        <h4 class="text-header pb-3">Opt-Out and Unsubscribing</h4>
                        <p class="dark-text">
                            You will comply promptly with all opt-out, unsubscribe, "do not call" and "do not send" requests. For the duration of this Agreement, you will establish and maintain systems and procedures appropriate to effectuate all opt-out, unsubscribe, "do not call" and "do not send" requests.
                        </p>
                        <h4 class="card-title">Opt-Out and Unsubscribing</h4>
                        <p class="dark-text">You will comply promptly with all opt-out, unsubscribe, "do not call" and "do not send" requests. For the duration of this Agreement, you will establish and maintain systems and procedures appropriate to effectuate all opt-out, unsubscribe, "do not call" and "do not send" requests.</p>
                        <h4 class="card-title">Term and Termination</h4>
                        <ol class="mb-3" start="11" type="1">
                            <li class="dark-text mb-3"><strong>11. Term.</strong> This Agreement will apply for as long as you participate in the Affiliate Program until terminated.</li>
                            <li class="dark-text mb-3"><strong>12. Termination Without Cause.</strong> Both you and we may terminate this Agreement on fifteen (15) days written notice to the other party.</li>
                            <li class="dark-text mb-3"><strong>13. Termination for Agreement Changes.</strong> If we update or replace the terms of this Agreement, you may terminate this Agreement on five (5) days written notice to us, provided that you send us written notice within ten (10) days after we send you notice of the change.</li>
                            <li class="dark-text mb-3"><strong>14. Termination for Cause.</strong> We may terminate this Agreement: (i) upon thirty (30) days notice to you of a material breach if such breach remains uncured at the expiration of such period, (ii) upon fifteen (15) days notice to you of non-payment of any amount due to us if such amount remains unpaid at the expiration of such period, (iii) immediately, if you become the subject of a petition in bankruptcy or any other proceeding relating to insolvency, receivership, liquidation or assignment for the benefit of creditors, (iv) immediately, if you breach the terms applicable to your subscription with us (if you have one), including if you default on your payment obligations to us or our affiliate, or (v) immediately, if we determine that you are acting, or have acted, in a way that has or may negatively reflect on or affect us, our prospects, or our customers.</li>
                            <li class="dark-text mb-3"><strong>15. Effects of Expiration/Termination.</strong> Expiration of this Agreement, and termination of this Agreement: (i) without cause by us,(ii) by you with cause, (iii) by you according to the ‘Termination for Agreement Changes’ section, shall not affect our obligation to pay you a Commission, so long as the related payment by the Member Transaction is recognized by us within thirty (30) days after the date of such termination or expiration and provided that in no event shall you be entitled to payment of Commission under this Agreement if you are eligible to receive a revenue share payment under the Sales Solution Program Agreement, Sales Referral Program Agreement or Agency Partner Program Agreement. We will not pay you fees on Member Transactions recognized by us after thirty (30) days after the date of such termination or expiration set out above. Provided however, in the event of termination without cause by you, or for cause by us, our obligation to pay and your right to receive any Commission will terminate upon the date of such termination, regardless of whether you would have otherwise been eligible to receive Commission prior to the date of termination. Except as expressly set forth in this section, you are not eligible to receive a Commission payment after expiration, or termination of this Agreement. Upon termination or expiration, you will discontinue all use of and delete the Affiliate Tool that we make available to you for your participation in the Affiliate Program. Upon termination or expiration, an Affiliate Lead is not considered valid, and we may choose to maintain it in our database and engage with such a prospect.</li>
                        </ol>
                        <p class="dark-text">Upon termination or expiration, you will immediately discontinue all use of our trademark and references to this Affiliate Program from your website(s) and other collateral. For the avoidance of doubt, termination or expiration of this Agreement shall not cause a Customer’s subscription agreement to be terminated.</p>
                        <h4 class="card-title">Affiliate Representations and Warranties</h4>
                        <p class="dark-text"><strong>You represent and warrant that:</strong> (i) you have all sufficient rights and permissions to participate in the Affiliate Program and to provision MyMI Wallet with Affiliate Leads for our use in sales and marketing efforts or as otherwise set forth in this Agreement, (ii) your participation in this Affiliate Program will not conflict with any of your existing agreements or arrangements, and (iii) you own or have sufficient rights to use and to grant to us our right to use the Affiliate Marks.</p>
                        <p class="dark-text"><strong>You further represent and warrant that:</strong> (i) you will ensure that you are compliant with any trade or regulatory requirements that may apply to your participation in the Affiliate Program (for example, by clearly stating you are a MyMI Wallet Affiliate on any website(s) you own where you make an Affiliate Link available); (ii) you will accurately provide in the Affiliate Tool all websites and domains you own where you intend to use Affiliate Links to generate Affiliate Leads; (iii) you will not purchase ads that direct to your site(s) or through an Affiliate Link that could be considered as competing with Millennial Investment’s own advertising, including, but not limited to, our branded keywords; (iv) you will not participate in cookie stuffing or pop-ups, false or misleading links are strictly prohibited; (v) you will not attempt to mask the referring URL information; (vi) you will not use your own Affiliate Link to purchase MyMI Wallet products for yourself.</p>
                        <h4 class="card-title">Indemnification</h4>
                        <p class="dark-text">You will indemnify, defend and hold us harmless, at your expense, against any third-party claim, suit, action, or proceeding (each, an "Action") brought against us (and our officers, directors, employees, agents, service providers, licensors, and affiliates) by a third party not affiliated with us to the extent that such Action is based upon or arises out of (a) your participation in the Affiliate Program, (b) our use of the prospect data you provided us, (c) your noncompliance with or breach of this Agreement, (d) your use of the Affiliate Tool, or (e) our use of the Affiliate Marks. We will: notify you in writing within thirty (30) days of our becoming aware of any such claim; give you sole control of the defense or settlement of such a claim; and provide you (at your expense) with any and all information and assistance reasonably requested by you to handle the defense or settlement of the claim. You shall not accept any settlement that (i) imposes an obligation on us; (ii) requires us to make an admission; or (iii) imposes liability not covered by these indemnifications or places restrictions on us without our prior written consent.</p>
                        <h4 class="card-title">Disclaimers; Limitations of Liability</h4>
                        <p class="dark-text"><strong>16. Disclaimer of Warranties.</strong> WE AND OUR AFFILIATED COMPANIES AND AGENTS MAKE NO REPRESENTATIONS OR WARRANTIES ABOUT THE SUITABILITY, RELIABILITY, AVAILABILITY, TIMELINESS, SECURITY, OR ACCURACYv OF THE MYMI WALLET PRODUCTS, MYMI WALLET CONTENT, THE AFFILIATE PROGRAM, OR THE AFFILIATE TOOL FOR ANY PURPOSE. APPLICATION PROGRAMMING INTERFACES (APIs) AND THE AFFILIATE TOOL MAY NOT BE AVAILABLE AT ALL TIMES. TO THE EXTENT PERMITTED BY LAW, THE MYMI WALLET PRODUCTS AND AFFILIATE TOOLS ARE PROVIDED "AS IS" WITHOUT WARRANTY OR CONDITION OF ANY KIND. WE DISCLAIM ALL WARRANTIES AND CONDITIONS OF ANY KIND WITH REGARD TO THE MYMI WALLET PRODUCTS AND THE AFFILIATE TOOL INCLUDING ALL IMPLIED WARRANTIES OR CONDITIONS OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, AND NON-INFRINGEMENT.</p>
                        <p class="dark-text"><strong>17. No Indirect Damages.</strong> TO THE EXTENT PERMITTED BY LAW, IN NO EVENT SHALL EITHER PARTY BE LIABLE FOR ANY INDIRECT, PUNITIVE, OR CONSEQUENTIAL DAMAGES, INCLUDING LOST PROFITS OR BUSINESS OPPORTUNITIES.</p>
                        <p class="dark-text"><strong>18. Limitation of Liability.</strong> IF, NOTWITHSTANDING THE OTHER TERMS OF THIS AGREEMENT, WE ARE DETERMINED TO HAVE ANY LIABILITY TO YOU OR ANY THIRD PARTY, THE PARTIES AGREE THAT OUR AGGREGATE LIABILITY WILL BE LIMITED TO THE TOTAL COMMISSION AMOUNTS YOU HAVE ACTUALLY EARNED FOR THE RELATED MEMBER TRANSACTIONS IN THE TWELVE-MONTH PERIOD PRECEDING THE EVENT GIVING RISE TO A CLAIM.</p>
                        <p class="dark-text"><strong>19. Test Portal.</strong> WE DISCLAIM ALL LIABILITY WITH RESPECT TO THE TEST PORTAL THAT YOU USE. WE DO NOT PROMISE TO MAKE THE TEST PORTAL AVAILABLE TO YOU, AND WE MAY CHOOSE TO DO SO, OR NOT DO SO, AT OUR DISCRETION.</p>
                        <p class="dark-text"><strong>20. Cookie Duration.</strong> COOKIES USED AS PART OF THIS AFFILIATE PROGRAM HAVE A 90-DAY DURATION. IF A POTENTIAL MEMBER CLEARS THEIR COOKIES DURING THIS PERIOD, MYMI WALLET SHALL NOT BE LIABLE FOR ANY COMMISSIONS THAT MAY HAVE BEEN OWED TO YOU.</p>
                        <h4 class="card-title">Non-Solicitation</h4>
                        <p class="dark-text">You agree not to intentionally solicit for employment any of our employees or contractors during the term of this Agreement and for a period of twelve (12) months following the termination or expiration of this Agreement. Both you and we acknowledge that (i) any newspaper or other public solicitation not directed specifically to such person shall not be deemed to be a solicitation for purposes of this provision, and (ii) this provision is not intended to limit the mobility of either our employees or contractors.</p>
                        <h4 class="card-title">General</h4>
                        <p class="dark-text"><strong>21. Amendment; No Waiver.</strong> We may update and change any part or all of this Agreement, including by replacing it in its entirety. If we update or change this Agreement, the updated Agreement will be made available to you via the Affiliate Tool and we will let you know by email. The updated Agreement will become effective and binding on the next business day after we have notified you. When we change this Agreement, the "Last Modified" date above will be updated to reflect the date of the most recent version. We encourage you to review this Agreement periodically. If you don’t agree to the update, change, or replacement, you can choose to terminate as we describe above. No delay in exercising any right or remedy or failure to object will be a waiver of such right or remedy or any other right or remedy. A waiver on one occasion will not be a waiver of any right or remedy on any future occasion.</p>
                        <p class="dark-text"><strong>22. Applicable Law.</strong> This Agreement shall be governed by the laws of the Commonwealth of Massachusetts, without regard to the conflict of law’s provisions thereof. In the event either of us initiates an action in connection with this Agreement or any other dispute between the parties, the exclusive venue and jurisdiction of such action shall be in the state and federal courts in Boston, Massachusetts.</p>
                        <p class="dark-text"><strong>23. Force Majeure.</strong> Neither party will be responsible for failure or delay of performance if caused by: an act of war, hostility, or sabotage; an act of God; electrical, internet, or telecommunication outage that is not caused by the obligated party; government restrictions; or other events outside the reasonable control of the obligated party. Each party will use reasonable efforts to mitigate the effect of a force majeure event.</p>
                        <p class="dark-text"><strong>24. Actions Permitted.</strong> Except for actions for nonpayment or breach of a party’s proprietary rights, no action, regardless of form, arising out of or relating to this Agreement may be brought by either party more than one (1) year after the cause of action has accrued.</p>
                        <p class="dark-text"><strong>25. Relationship of the Parties.</strong> Both you and we agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of this Agreement.</p>
                        <p class="dark-text"><strong>26. Compliance with Applicable Laws.</strong> You shall comply and shall ensure that any third parties performing sales or referral activities on your behalf comply, with all applicable foreign and domestic laws (including without limitation export laws and laws applicable to sending unsolicited email), governmental regulations, ordinances, and judicial administrative orders. You shall not engage in any deceptive, misleading, illegal, or unethical marketing activities or activities that otherwise may be detrimental to us, our customers, or the public. Export laws and regulations of the United States and any other relevant local export laws and regulations may apply to the MyMI Wallet Products. You will comply with the sanctions programs administered by the Office of Foreign Assets Control (OFAC) of the US Department of the Treasury. You will not directly or indirectly export, re-export, or transfer the MyMI Wallet Products to prohibited countries or individuals or permit the use of the MyMI Wallet Products by prohibited countries or individuals.</p>
                        <p class="dark-text"><strong>27. Severability.</strong> If any part of this Agreement is determined to be invalid or unenforceable by applicable law, then the invalid or unenforceable provision will be deemed superseded by a valid, enforceable provision that most closely matches the intent of the original provision and the remainder of this Agreement will continue in effect.</p>
                        <p class="dark-text"><strong>28. Notices.</strong> Notice will be sent to the contact address set forth herein (as such may be changed by notice given to the other party) and will be deemed delivered as of the date of actual receipt.</p>
                        <p class="dark-text"><strong>To MyMI Wallet, LLC.:</strong><br>My Millennial Investments, LLC.<br>2304 Ashland Avenue<br>Bossier City, LA 71111, U.S.A.<br>Attention: General Counsel</p>
                        <p class="dark-text"><strong>To you:</strong><br>Your address is provided in our affiliate account information for you.</p>
                        <p class="dark-text">We may give electronic notices specific to you by email to your e-mail address(es) on record in our account information for you. We may give notice to you by telephone calls to the telephone numbers on record in our account information for you.</p>
                        <p class="dark-text"><strong>Entire Agreement.</strong> This Agreement is the entire agreement between us for the Affiliate Program and supersedes all other proposals and agreements, whether electronic, oral, or written, between us. We object to and reject any additional or different terms proposed by you, including those contained in your purchase order, acceptance, or website. Our obligations are not contingent on the delivery of any future functionality or features of the MyMI Wallet Products or dependent on any oral or written public comments made by us regarding future functionality or features of the MyMI Wallet Products. It is the express wish of both you and us that this Agreement and all related documents be drawn up in English. We might make versions of this Agreement available in languages other than English. If we do, the English version of this Agreement will govern our relationship, and the translated version is provided for convenience only and will not be interpreted to modify the English version of this Agreement.</p>
                        <p class="dark-text"><strong>Assignment.</strong> You will not assign or transfer this Agreement, including any assignment or transfer by reason of merger, reorganization, sale of all or substantially all of its assets, change of control, or operation of law, without our prior written consent. We may assign this Agreement to any affiliate or in the event of a merger, reorganization, sale of all or substantially all of our assets, change of control, or operation of law.</p>
                        <p class="dark-text"><strong>No Third-Party Beneficiaries.</strong> Nothing in this Agreement, express or implied, is intended to or shall confer upon any person or entity (other than the parties hereto) any right, benefit, or remedy of any nature whatsoever under or by reason of this Agreement.</p>
                        <p class="dark-text"><strong>Program Policies Page.</strong> We may change the Program Policies from time to time. Your participation in the Affiliate Program is subject to the Program Policies, which are incorporated herein by reference</p>
                        <p class="dark-text"><strong>No Licenses.</strong> We grant to you only the rights and licenses expressly stated in this Agreement, and you receive no other rights or licenses with respect to us, the MyMI Wallet Products, our trademarks, or any other property or right of ours.</p>
                        <p class="dark-text"><strong>Sales by MyMI Wallet.</strong> This Agreement shall in no way limit our right to sell the MyMI Wallet Products, directly or indirectly, to any current or prospective customers.</p>
                        <p class="dark-text"><strong>Authority.</strong> Each party represents and warrants to the other that it has full power and authority to enter into this Agreement and that it is binding upon such party and enforceable under its terms.</p>
                        <p class="dark-text"><strong>Survival.</strong> The following sections shall survive the expiration or termination of this Agreement: ‘Commission and Payment’, ‘Proprietary Rights’, ‘Confidentiality’, ‘Effects of Termination/Expiration’, ‘Indemnification’, ‘Disclaimers; Limitation of Liability’, ‘Non-Solicitation’ and ‘General’.</p>
                        <h5 class="card-title">Exhibit A</h5>
                        <p class="dark-text">MyMI Wallet – GDPR Data Processing Addendum (Affiliates)</p>
                        <p class="dark-text">This Data Processing Addendum ("Addendum") sets out the terms that apply between MyMI Wallet and Marketing Affiliate when processing EEA personal data in connection with the Affiliate Program. This Addendum forms part of the Affiliate Program Agreement. Capitalized terms used in this Addendum shall have the meanings given to them in the Affiliate Program Agreement (the "Agreement") unless otherwise defined in this Addendum.</p>
                        <ul class="dark-text">
                            <li class="mb-3"><strong>Definitions:</strong> (a) "controller," "processor," "data subject," and "processing" (and "process") shall have the meanings given to them in Applicable Data Protection Law; (b) "Applicable Data Protection Law" means any and all applicable privacy and data protection laws and regulations applicable to the Personal Data in question, including, where applicable, EU Data Protection Law (in each case, as may be amended, superseded or replaced from time to time); (c) "EU Data Protection Law" means: (i) the EU General Data Protection Regulation (Regulation 2016/679) ("GDPR"); and (ii) the EU e-Privacy Directive (Directive 2002/58/EC); and (iii) any national data protection laws made under or according to clause (i) or (ii); and (d) "Personal Data" means any information relating to an identified or identifiable natural person to the extent that such information is protected as personal data under Applicable Data Protection Law.</li>
                            <li class="mb-3"><strong>Purposes of processing.</strong> The parties acknowledge that in connection with the Affiliate Program, each party may provide or make available to the other party Personal Data. Each party shall process such data: (i) for the purposes described in the Agreement; and/or (ii) as may otherwise be permitted under Applicable Data Protection Law.</li>
                            <li class="mb-3"><strong>Relationship of the parties.</strong> Each party will process the copy of the Personal Data in its possession or control as an independent controller (not as a joint controller with the other party). For the avoidance of doubt and without prejudice to the foregoing, MyMI Wallet shall be an independent controller of any Personal Data that it receives or shares with Affiliate in connection with the Affiliate Program.</li>
                            <li class="mb-3"><strong>Compliance with the law.</strong> Each party shall separately comply with its obligations under Applicable Data Protection Law and this Addendum when processing Personal Data. Neither party shall be responsible for the other party's compliance with Applicable Data Protection Law. In particular, each party shall be individually responsible for ensuring that it's processing of the Personal Data is lawful, fair, and transparent, and shall make available to data subjects a privacy statement that fulfills the requirements of the Applicable Data Protection Law.</li>
                            <li class="mb-3"><strong>International transfers.</strong> Where Applicable Data Protection Law in the European Economic Area ("EEA"), and/or its member states, United Kingdom and/or Switzerland (collectively for the purposes of this Addendum, the "EU'), applies to the Personal Data ("EU Personal Data"), neither party shall process any EU Personal Data (nor permit any EU Personal Data to be processed) in a territory outside of the EU unless it has taken such measures as are necessary to ensure the transfer is in compliance with Applicable Data Protection Law. To the extent a Marketing Affiliate transfers EU Personal Data to MyMI Wallet and MyMI Wallet is located in a territory outside the EU that does not provide adequate protection for Personal Data (as determined by Applicable Data Protection Law), MyMI Wallet agrees to abide by and process such EU Personal Data in accordance with the Standard Contractual Clauses for Controllers as approved by the European Commission and available at <a href="http://eur-lex.europa.eu/legal-content/EN/TXT/?uri=CELEX%3A32004D0915">http://eur-lex.europa.eu/legal-content/EN/TXT/?uri=CELEX%3A32004D0915</a> (as amended, superseded or updated from time to time) ("Model Clauses"), which are incorporated by reference in, and form an integral part of, this Addendum. MyMI Wallet agrees that it is a "data importer" and the Marketing Affiliate is the "data exporter" under the Model Clauses (notwithstanding that MyMI Wallet may be an entity located outside of the EEA).</li>
                            <li class="mb-3"><strong>Security:</strong> Each party shall implement and maintain all appropriate technical and organizational measures to protect any copies of the Personal Data in their possession or control from (i) accidental or unlawful destruction, and (ii) loss, alteration, or unauthorized disclosure or access (a "Security Incident") and to preserve the security and confidentiality of such Personal Data. Each party shall notify the other party without undue delay on becoming aware of any breach of the EU Data Protection Law/Applicable Data Protection Law.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>