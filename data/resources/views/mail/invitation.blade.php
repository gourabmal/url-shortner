<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You're invited to join {{ $invitation->company->name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Fraunces:ital,wght@0,300;0,600;1,300&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #F0EDE8;
            font-family: 'Inter', Arial, sans-serif;
            color: #1A1A1A;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            max-width: 560px;
            margin: 16px auto;
            padding: 0 16px 16px;
        }

        /* Header bar */
        .header {
            background-color: #1A1A1A;
            border-radius: 12px 12px 0 0;
            padding: 16px 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #C8F04A;
            display: inline-block;
            flex-shrink: 0;
            margin-top: 1px;
            margin-right: 8px;
        }

        .header-label {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: none;
            color: #FFFFFF;
            line-height: 1;
        }

        /* Card body */
        .card {
            background-color: #FFFFFF;
            padding: 28px 28px 20px;
            border-radius: 0 0 12px 12px;
        }











        .body-text {
            font-size: 13px;
            line-height: 1.6;
            color: #4A4A4A;
            margin-bottom: 20px;
        }

        /* CTA */
        .cta-wrapper {
            margin-bottom: 20px;
        }

        .cta-button {
            display: inline-block;
            background-color: #1A1A1A;
            color: #C8F04A !important;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 24px;
            border-radius: 6px;
        }

        /* Role badge */
        .role-badge {
            display: inline-block;
            background-color: #F0EDE8;
            border: 1px solid #E0DDD8;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #555;
            padding: 4px 8px;
            margin-bottom: 16px;
        }

        /* Expiry notice */
        .expiry-block {
            margin-top: 16px;
        }

        .expiry-label {
            font-size: 11px;
            font-weight: 500;
            color: #999;
        }



        @media (max-width: 480px) {
            .header, .card, .footer {
                padding-left: 24px;
                padding-right: 24px;
            }

            .headline, .company-name {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">

    <div class="header">
        <span class="header-dot"></span>
        <span class="header-label">{{ $invitation->company->name }}</span>
    </div>

    <div class="card">

        <span class="role-badge">{{ $invitation->role }}</span>

        <p class="body-text">
            Hi {{ $invitation->name }}, you've been invited to join
            <strong>{{ $invitation->company->name }}</strong> as a
            <strong>{{ $invitation->role }}</strong>. Accept your invitation
            to set up your account and start collaborating with your team.
        </p>

        <div class="cta-wrapper">
            <a href="{{ route('invitation.accept', $invitation->token) }}" class="cta-button">
                Accept Invitation →
            </a>
        </div>

        <div class="expiry-block">
            <p class="expiry-label">Expires &nbsp; {{ $invitation->expires_at->format('d M Y') }} at {{ $invitation->expires_at->format('h:i A') }}</p>
        </div>

    </div>

</div>

</body>
</html>