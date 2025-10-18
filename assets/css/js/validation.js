// assets/js/validation.js

function showMessage(container, message, type='error'){
  container.innerHTML = `<div class="message ${type==='success'?'success':'error'}">${message}</div>`;
  setTimeout(()=>{ if(container) container.innerHTML = '' }, 6000);
}

function validateLoginForm(form){
  const u = form.username.value.trim();
  const p = form.password.value.trim();
  const out = document.getElementById('formMessages');
  if(!u || !p){ showMessage(out,'Please provide username and password'); return false; }
  return true;
}

function validateRegisterForm(form){
  const user = form.username.value.trim();
  const pw = form.password.value;
  const full = form.full_name.value.trim();
  const out = document.getElementById('formMessages');
  if(!full || !user || !pw){ showMessage(out,'All fields are required'); return false; }
  if(pw.length < 6){ showMessage(out,'Password must be at least 6 characters'); return false; }
  return true;
}

/* Attach submit handlers (call in each page's <script>) */
function attachLoginHandler(){
  const f = document.getElementById('loginForm');
  if(!f) return;
  f.addEventListener('submit', function(e){
    if(!validateLoginForm(f)){ e.preventDefault(); }
  });
}
function attachRegisterHandler(){
  const f = document.getElementById('registerForm');
  if(!f) return;
  f.addEventListener('submit', function(e){
    if(!validateRegisterForm(f)){ e.preventDefault(); }
  });
}
