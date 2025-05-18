<div class="login-container" [@fadeInOut]>
  <div class="login-card" [@slideIn]>
    <div class="brand-logo" [@bounceIn]>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
      </svg>
      <h1>HELLOWEB</h1>
      <p class="tagline">Votre plateforme d'apprentissage en ligne</p>
    </div>

    <form [formGroup]="loginForm" (ngSubmit)="onSubmit()" class="login-form">
      <div class="form-group" [class.focused]="emailFocused" [class.valid]="loginForm.get('email')?.valid">
        <label for="email">Email</label>
        <input 
          type="email" 
          id="email" 
          formControlName="email"
          (focus)="emailFocused = true"
          (blur)="emailFocused = false"
          (input)="validateField('email')">
        <div class="underline"></div>
        <div class="validation-icon">
          <i class="fas fa-check"></i>
        </div>
        <div class="error-message" *ngIf="loginForm.get('email')?.invalid && loginForm.get('email')?.touched">
          Veuillez entrer un email valide
        </div>
      </div>

      <div class="form-group" [class.focused]="passwordFocused" [class.valid]="loginForm.get('password')?.valid">
        <label for="password">Mot de passe</label>
        <input 
          type="password" 
          id="password" 
          formControlName="password"
          (focus)="passwordFocused = true"
          (blur)="passwordFocused = false"
          (input)="validateField('password')">
        <div class="underline"></div>
        <div class="validation-icon">
          <i class="fas fa-check"></i>
        </div>
        <div class="error-message" *ngIf="loginForm.get('password')?.invalid && loginForm.get('password')?.touched">
          Le mot de passe est requis
        </div>
        <div class="password-toggle" (click)="togglePasswordVisibility()">
          <i class="fas" [class.fa-eye]="!showPassword" [class.fa-eye-slash]="showPassword"></i>
        </div>
      </div>

      <div class="form-footer">
        <div class="remember-me">
          <input type="checkbox" id="remember" formControlName="remember">
          <label for="remember" class="checkbox-label">
            <span class="custom-checkbox"></span>
            Se souvenir de moi
          </label>
        </div>
        <a href="#" class="forgot-password" (click)="showForgotPassword($event)">Mot de passe oublié ?</a>
      </div>

      <button type="submit" class="login-btn" [disabled]="loginForm.invalid || isLoading" [@pulse]="loginForm.valid && !isLoading">
        <span *ngIf="!isLoading">Connexion</span>
        <span *ngIf="isLoading" class="spinner"></span>
      </button>

      <div class="social-login">
        <div class="divider">
          <span class="divider-line"></span>
          <span class="divider-text">Ou connectez-vous avec</span>
          <span class="divider-line"></span>
        </div>
        <div class="social-icons">
          <button type="button" class="social-btn google" (click)="loginWithGoogle()" [@hoverAnimation]="googleHover" 
                  (mouseenter)="googleHover = 'hover'" (mouseleave)="googleHover = 'leave'">
            <i class="fab fa-google"></i>
            <span>Google</span>
          </button>
          <button type="button" class="social-btn facebook" (click)="loginWithFacebook()" [@hoverAnimation]="facebookHover"
                  (mouseenter)="facebookHover = 'hover'" (mouseleave)="facebookHover = 'leave'">
            <i class="fab fa-facebook-f"></i>
            <span>Facebook</span>
          </button>
          <button type="button" class="social-btn linkedin" (click)="loginWithLinkedIn()" [@hoverAnimation]="linkedinHover"
                  (mouseenter)="linkedinHover = 'hover'" (mouseleave)="linkedinHover = 'leave'">
            <i class="fab fa-linkedin-in"></i>
            <span>LinkedIn</span>
          </button>
        </div>
      </div>

      <div class="register-link">
        Nouveau sur E-learning ? <a routerLink="/register" [@underlineAnimation]>Créez un compte</a>
      </div>
    </form>
  </div>

  <div class="login-bg">
    <div class="floating-elements">
      <div class="bubble bubble-1" [@floatAnimation]></div>
      <div class="bubble bubble-2" [@floatAnimation]></div>
      <div class="bubble bubble-3" [@floatAnimation]></div>
      <div class="bubble bubble-4" [@floatAnimation]></div>
      <div class="shape shape-1" [@shapeAnimation]></div>
      <div class="shape shape-2" [@shapeAnimation]></div>
    </div>
  </div>

  <div class="particles-js" id="particles-js"></div>
</div>