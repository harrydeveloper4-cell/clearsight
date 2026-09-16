<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'ClearSight Care Portal')</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
<!--<link rel="stylesheet" href="{{ asset('css/auth.css') }}">-->

<style>
:root {
    --navy: #0B2545;
    --navy-light: #13376e;
    --teal: #0ea5b5;
    --teal-light: #22d3ee;
    --teal-pale: #e0f7fa;
    --white: #ffffff;
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-400: #94a3b8;
    --gray-600: #475569;
    --gray-800: #1e293b;
    --danger: #ef4444;
}
    body{
        font-family: 'DM Sans', sans-serif;
        background: linear-gradient(272deg, var(--navy) 0%, #0e3a6e 50%, #0a6b7c 100%);
        display: flex;
    }
    body::before {
        position: absolute;
     }
    .terms-wrapper {
        /*max-width: 1000px;*/
        margin: auto;
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow-y: auto;
        /*height: calc(100vh - 180px);*/
    }

    .terms-wrapper h1 {
        font-size: 32px;
        margin-bottom: 25px;
        color: #222;
    }

    .terms-wrapper h2 {
        font-size: 24px;
        margin-top: 35px;
        margin-bottom: 15px;
        color: #111;
    }

    .terms-wrapper h3 {
        font-size: 18px;
        margin-top: 25px;
        margin-bottom: 10px;
        color: #333;
    }

    .terms-wrapper p,
    .terms-wrapper li {
        font-size: 15px;
        line-height: 1.8;
        color: #555;
    }

    .terms-wrapper ul {
        padding-left: 20px;
    }

    .terms-wrapper li {
        margin-bottom: 8px;
    }
    
</style>
</head>
<body>

    <div class="terms-wrapper">

        <h2>ClearSight Care Portal – Terms of Use</h2>

        <p>
            Welcome to the ClearSight Care Portal. By accessing or using this portal,
            you agree to comply with and be bound by the following terms and conditions.
        </p>

        <hr>

        <h3>1. About ClearSight</h3>
        <p>
            ClearSight Domiciliary provides specialist mobile eye care and hearing care
            services for care homes, including:
        </p>

        <ul>
            <li>Comprehensive eye examinations</li>
            <li>Spectacles supply and aftercare</li>
            <li>Hearing care services</li>
            <li>Clinical support and communication</li>
        </ul>

        <hr>

        <h3>2. Portal Purpose</h3>
        <p>
            The ClearSight Care Portal is designed to help care homes:
        </p>

        <ul>
            <li>Manage resident information</li>
            <li>Track eye care and hearing care status</li>
            <li>Request services</li>
            <li>Access care plans and prescriptions</li>
            <li>Communicate securely with ClearSight staff</li>
        </ul>

        <hr>

        <h3>3. User Responsibilities</h3>
        <p>All users agree to:</p>

        <ul>
            <li>Provide accurate and up-to-date information</li>
            <li>Maintain confidentiality of login credentials</li>
            <li>Use the portal only for authorised healthcare purposes</li>
            <li>Comply with all applicable healthcare and data protection regulations</li>
        </ul>

        <hr>

        <h3>4. Data Protection & GDPR</h3>
        <p>
            This portal contains sensitive resident healthcare information.
            ClearSight is committed to maintaining GDPR compliance and secure handling of all data.
        </p>

        <ul>
            <li>Secure login is required for all users</li>
            <li>Care homes may only access their own data</li>
            <li>Data is encrypted and securely stored</li>
            <li>Audit logs may be maintained for security and compliance purposes</li>
        </ul>

        <hr>

        <h3>5. Acceptable Use</h3>
        <p>Users must not:</p>

        <ul>
            <li>Attempt to access unauthorised data</li>
            <li>Share confidential resident information improperly</li>
            <li>Use the portal for unlawful activities</li>
            <li>Disrupt or interfere with portal operations</li>
        </ul>

        <hr>

        <h3>6. Service Requests</h3>
        <p>
            Requests submitted through the portal, including sight tests,
            replacement glasses, ear wax removal, and hearing care requests,
            are logged internally and tracked through the system.
        </p>

        <hr>

        <h3>7. Messaging & Communications</h3>
        <p>
            The portal includes a secure messaging system to support communication
            between care homes and ClearSight staff.
        </p>

        <p>
            Users are responsible for ensuring messages and updates are reviewed regularly.
        </p>

        <hr>

        <h3>8. Document Access</h3>
        <p>
            Care plans, prescriptions, and related healthcare documents made available
            through the portal are confidential and intended solely for authorised users.
        </p>

        <hr>

        <h3>9. System Availability</h3>
        <p>
            ClearSight aims to maintain reliable portal availability but does not guarantee
            uninterrupted access at all times due to maintenance or technical issues.
        </p>

        <hr>

        <h3>10. Limitation of Liability</h3>
        <p>
            ClearSight shall not be liable for any indirect, incidental, or consequential
            damages resulting from the use or inability to use the portal.
        </p>

        <hr>

        <h3>11. Changes to Terms</h3>
        <p>
            ClearSight reserves the right to update or modify these Terms of Use at any time.
            Continued use of the portal constitutes acceptance of any revised terms.
        </p>

        <hr>

        <h3>12. Contact Information</h3>
        <p>
            If you have any questions regarding these Terms of Use,
            please contact the ClearSight administration team.
        </p>

</div>


</body>
</html>
