@extends('layouts.app')

@section('title', 'Portal Policy')

@section('content')

<style>
    .terms-wrapper {
        margin: auto;
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow-y: auto;
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
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
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

    .terms-wrapper hr {
        margin: 30px 0;
        border: none;
        border-top: 1px solid #e5e5e5;
    }
@media (max-width: 575px) {
.terms-wrapper {
    padding: 5px;
}
.terms-wrapper h1 {
    font-size: 24px;
}
.terms-wrapper h2 {
    font-size: 18px;
}

}
</style>

<div class="terms-wrapper">

    <h1>ClearSight Domiciliary Portal Policy Suite</h1>

    <p>
        This Portal Policy Suite outlines the standards, responsibilities,
        and procedures governing the use of the ClearSight Care Portal.
        These policies are designed to ensure compliance, confidentiality,
        security, and professional healthcare management.
    </p>

 

    <h2>1. Data Protection & Privacy Policy</h2>

    <h3>1.1 Purpose</h3>
    <p>
        This policy explains how ClearSight Domiciliary Ltd collects,
        processes, stores, and protects personal data through the portal.
    </p>

    <h3>1.2 Data Controller</h3>
    <p>
        ClearSight Domiciliary Ltd acts as the Data Controller for all
        personal and healthcare-related data processed through the system.
    </p>

    <h3>1.3 Lawful Basis for Processing</h3>

    <ul>
        <li>Article 6(1)(e) – Public task</li>
        <li>Article 9(2)(h) – Health and social care provision</li>
    </ul>

    <h3>1.4 Data Collected</h3>

    <ul>
        <li>Resident personal details</li>
        <li>Clinical and eye care records</li>
        <li>Care plans and prescriptions</li>
        <li>Appointment and recall history</li>
        <li>Portal communications and requests</li>
    </ul>

    <h3>1.5 Data Retention</h3>

    <ul>
        <li>Clinical records retained in line with NHS guidance</li>
        <li>Operational portal data retained only where necessary</li>
    </ul>

    <h3>1.6 Data Sharing</h3>

    <ul>
        <li>Only authorised healthcare professionals may access data</li>
        <li>Data is never shared unlawfully or unnecessarily</li>
        <li>Information may be disclosed where legally required</li>
    </ul>

 

    <h2>2. Information Security Policy</h2>

    <h3>2.1 Security Standards</h3>

    <ul>
        <li>NHS DSPT aligned principles</li>
        <li>Cyber Essentials security standards</li>
        <li>Secure encrypted infrastructure</li>
    </ul>

    <h3>2.2 Access Control</h3>

    <ul>
        <li>Unique login credentials for each care home</li>
        <li>Role-based permissions</li>
        <li>No cross-organisation visibility</li>
        <li>Strong password requirements</li>
    </ul>

    <h3>2.3 Encryption</h3>

    <ul>
        <li>Encrypted HTTPS/TLS connections</li>
        <li>Encrypted data storage</li>
    </ul>

    <h3>2.4 User Security Responsibilities</h3>

    <ul>
        <li>Users must not share passwords</li>
        <li>Devices must remain secure</li>
        <li>Users should log out after each session</li>
    </ul>

 

    <h2>3. User Access & Acceptable Use Policy</h2>

    <h3>3.1 Authorised Users</h3>

    <ul>
        <li>Approved care home staff</li>
        <li>Authorised ClearSight personnel</li>
    </ul>

    <h3>3.2 Acceptable Use</h3>

    <ul>
        <li>Use the portal only for healthcare purposes</li>
        <li>Access residents under your care only</li>
        <li>Maintain confidentiality at all times</li>
    </ul>

    <h3>3.3 Prohibited Activities</h3>

    <ul>
        <li>Unauthorised data access</li>
        <li>Sharing confidential information externally</li>
        <li>Attempting to bypass security systems</li>
        <li>Misuse of portal communication tools</li>
    </ul>

    <h3>3.4 Account Management</h3>

    <ul>
        <li>Accounts are issued and managed by ClearSight</li>
        <li>Inactive or former staff accounts will be disabled</li>
    </ul>

 

    <h2>4. Confidentiality & Clinical Governance Policy</h2>

    <h3>4.1 Confidential Information</h3>

    <ul>
        <li>All resident information is treated as confidential</li>
        <li>NHS confidentiality standards apply at all times</li>
    </ul>

    <h3>4.2 Staff Compliance</h3>

    <ul>
        <li>All staff receive GDPR training</li>
        <li>Compliance procedures are regularly reviewed</li>
        <li>Clinical governance standards are maintained</li>
    </ul>

    <h3>4.3 Care Home Responsibilities</h3>

    <ul>
        <li>Ensure authorised staff only access the portal</li>
        <li>Maintain internal confidentiality controls</li>
        <li>Report security or privacy concerns immediately</li>
    </ul>

 

    <h2>5. Audit & Monitoring Policy</h2>

    <h3>5.1 Audit Logs</h3>

    <ul>
        <li>User login activity</li>
        <li>Resident record updates</li>
        <li>Portal actions and requests</li>
    </ul>

    <h3>5.2 Monitoring</h3>

    <ul>
        <li>Regular compliance audits are conducted</li>
        <li>Unauthorised activity may be investigated</li>
    </ul>

 

    <h2>6. Third-Party & Data Processor Policy</h2>

    <ul>
        <li>All third-party providers must be GDPR compliant</li>
        <li>Data Processing Agreements will be maintained</li>
        <li>Approved secure hosting environments will be used</li>
    </ul>

 

    <h2>7. Backup & Business Continuity Policy</h2>

    <ul>
        <li>Regular encrypted backups are maintained</li>
        <li>Disaster recovery procedures are in place</li>
        <li>Critical systems are monitored for uptime</li>
    </ul>

 

    <h2>8. Consent & Transparency Policy</h2>

    <ul>
        <li>Residents or representatives will be informed where required</li>
        <li>Privacy notices will be available</li>
        <li>Consent procedures will be followed when applicable</li>
    </ul>

 

    <h2>9. Policy Updates</h2>

    <p>
        ClearSight reserves the right to update these policies to maintain
        legal, operational, and healthcare compliance standards.
    </p>

    <p>
        Continued use of the portal constitutes acceptance of any updated policies.
    </p>

</div>

@endsection