<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Sembark — Coming Soon</title>
<meta name="description" content="Sembark — every journey starts with a departure. Coming soon." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *{box-sizing:border-box}
  body{
    margin:0;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:
      radial-gradient(700px 400px at 50% -10%, rgba(255,255,255,.05), transparent 70%),
      #08080a;
    color:#f5f5f4;
    font-family:'Inter',sans-serif;
    text-align:center;
    padding:1.5rem;
  }

  .card{
    max-width:440px;
    width:100%;
    padding:3rem 2.5rem;
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    background:linear-gradient(180deg, rgba(255,255,255,.03), rgba(255,255,255,0));
    animation:rise .6s ease-out;
  }
  @keyframes rise{
    from{opacity:0;transform:translateY(10px)}
    to{opacity:1;transform:translateY(0)}
  }

  .brand{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:.55rem;
    margin-bottom:2.25rem;
  }
  .mark{
    width:30px;height:30px;
    border-radius:8px;
    background:conic-gradient(from 210deg,#e8e8e8,#a8a8a8 40%,#4a4a4a 70%,#e8e8e8);
  }
  .brand span{
    font-size:.95rem;
    font-weight:600;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:#d4d4d4;
  }

  h1{
    font-family:'Fraunces',serif;
    font-weight:500;
    font-size:clamp(2rem,5vw,2.6rem);
    line-height:1.15;
    margin:0 0 .9rem;
    color:#fafaf9;
  }

  p{
    color:#9c9c9c;
    font-size:.98rem;
    line-height:1.65;
    margin:0 0 2.25rem;
  }

  form{
    display:flex;
    flex-direction:column;
    gap:.7rem;
  }

  input[type="email"]{
    padding:.9rem 1rem;
    border-radius:10px;
    border:1px solid rgba(255,255,255,.1);
    background:#141414;
    color:#fff;
    font-family:'Inter',sans-serif;
    font-size:.95rem;
    width:100%;
    transition:border-color .15s ease;
  }
  input[type="email"]::placeholder{color:#666}
  input[type="email"]:focus-visible{
    outline:none;
    border-color:rgba(255,255,255,.35);
  }

  button{
    padding:.9rem 1.4rem;
    border-radius:10px;
    border:none;
    background:#fafaf9;
    color:#0a0a0a;
    font-weight:600;
    font-size:.95rem;
    cursor:pointer;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  button:hover{
    transform:translateY(-1px);
    box-shadow:0 6px 20px rgba(255,255,255,.12);
  }
  button:focus-visible{
    outline:2px solid #fafaf9;
    outline-offset:2px;
  }

  .note{
    display:block;
    margin-top:1.1rem;
    font-size:.8rem;
    color:#5c5c5c;
  }
</style>
</head>
<body>
  <div class="card">
    <div class="brand">
      <span class="mark"></span>
      <span>Sembark</span>
    </div>

    <h1>Coming soon</h1>
    <p>We're building something worth the wait. Leave your email and we'll let you know the moment we launch.</p>

    <form onsubmit="event.preventDefault(); this.querySelector('.note').textContent='Thanks — we\'ll be in touch.';">
      <input type="email" placeholder="Enter your email" required aria-label="Email address" />
      <button type="submit">Notify me</button>
    </form>
    <span class="note">No spam, just one email at launch.</span>
  </div>
</body>
</html>