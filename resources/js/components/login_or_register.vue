<template>

        <div :class="{ 'd-none': isAuthenticated, 'space-x-8': true, 'sm:-my-px': true, 'sm:ms-10': true, 'sm:flex': true }">
            <a href="#" id="loginButton" data-bs-toggle="modal" data-bs-target="#login" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-transparent focus:outline-none focus:text-gray-700 focus:border-transparent transition duration-150 ease-in-out">
                Login
            </a>
            <a href='#'  data-bs-toggle="modal" data-bs-target="#register"  class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-transparent focus:outline-none focus:text-gray-700 focus:border-transparent transition duration-150 ease-in-out">
                Register
            </a>
        </div>

        <div :class="{ 'd-none': !isAuthenticated, 'space-x-8': true, 'sm:-my-px': true, 'sm:ms-10': true, 'sm:flex': true }">
            <a href='#' @click="logout" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-transparent focus:outline-none focus:text-gray-700 focus:border-transparent transition duration-150 ease-in-out">
                Logout
            </a>
        </div>

    <!-- Login -->
    <div class="modal" ref="modalLogin" id="login" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                </div>
                <div v-if="!loading">
                    <div class="modal-body">
                    <form action="#" id="loginForm" @submit.prevent="login">
                        <div v-if="error != null">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">                
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></button>
                            </div>
                         </div>
                        <!-- Email Address -->
                        <div>
                            <label for="login_email">Email</label>
                            <input id="login_email" v-model="form.email" :class="{'form-control': true, 'is-invalid': form.errors.has('email')}" type="email" name="email"/>
                            <div v-if="form.errors.has('email')" class='text text-danger' v-html="form.errors.get('email')"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="login_password">Password</label>
                            <input id="login_password" v-model="form.password" :class="{'form-control': true, 'is-invalid': form.errors.has('password')}" type="password" name="password" />
                            <div v-if="form.errors.has('password')" class='text text-danger' v-html="form.errors.get('password')"/>
                        </div>

                        <div ref="captcha_login" class="g-recaptcha mt-3"></div>
                        <div v-if="form.errors.has('grecaptchaResponse')" class='text text-danger' v-html="form.errors.get('grecaptchaResponse')"/>
                    </form>
                    </div>
                </div>
                <div v-else>
                    <div class="modal-body d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status"/>
                        <span style="position: relative; top: 6px; left:6px">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" data-bs-dismiss="modal">Close</button>
                    <button form="loginForm" type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">Login</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Register -->
    <div class="modal" ref="modaRegister" id="register" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register</h5>
                </div>
                <div v-if="!loading">
                    <div class="modal-body">
                    <form action="#" id="registerForm" @submit.prevent="register">
                        <div v-if="error != null">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">                
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></button>
                            </div>
                         </div>
                        <!-- Name -->
                        <div>
                            <label for="name">Name</label>
                            <input id="password_name" v-model="form.name" :class="{'form-control': true, 'is-invalid': form.errors.has('name')}" type="text" name="name"/>
                            <div v-if="form.errors.has('name')" class='text text-danger' v-html="form.errors.get('name')"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <label for="email">Email</label>
                            <input id="password_email" v-model="form.email" :class="{'form-control': true, 'is-invalid': form.errors.has('email')}" type="email" name="email"/>
                            <div v-if="form.errors.has('email')" class='text text-danger' v-html="form.errors.get('email')"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password">Password</label>
                            <input id="password" v-model="form.password" :class="{'form-control': true, 'is-invalid': form.errors.has('password')}" type="password" name="password" autocomplete />
                            <div v-if="form.errors.has('password')" class='text text-danger' v-html="form.errors.get('password')"/>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" v-model="form.password_confirmation" :class="{'form-control': true, 'is-invalid': form.errors.has('password_confirmation')}" type="password" name="password_confirmation" autocomplete />
                            <div v-if="form.errors.has('password_confirmation')" class='text text-danger' v-html="form.errors.get('password_confirmation')"/>
                        </div>


                        <div ref="captcha_register" class="g-recaptcha mt-3"></div>
                        <div v-if="form.errors.has('g-recaptcha-response')" class='text text-danger' v-html="form.errors.get('g-recaptcha-response')"/>

                    </form>
                    </div>
                </div>
                <div v-else>
                    <div class="modal-body d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status"/>
                        <span style="position: relative; top: 6px; left:6px">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" data-bs-dismiss="modal">Close</button>
                    <button form="registerForm" type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">Register</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
  export default {
    data() {
        return {
         message: null,
         loading: false,
         error: null,
         recaptchaKey: null,
         isAuthenticated: false,
         captchaResponse: null,
         form: new Form({
            email: '',
            name: '',
            password: '',
            password_confirmation: '',
            captchaResponse: '',
            }),
        };
    },
    mounted() {
        this.checkAuthentication();
        this.loadRecaptchaScript();;
    },
    methods: {
        loadRecaptchaScript(){
            const script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?render=explicit';
            script.async = true;
            script.defer = true;

            script.onload = () => {
                this.renderCaptcha();
            };
            script.onerror = (error) => {
            console.error('Ошибка при загрузке скрипта reCAPTCHA:', error);
        };

        document.head.appendChild(script);

        },
        async renderCaptcha() {
            try {
                const response = await axios.get('/get-recaptcha-key');
                this.recaptchaKey = response.data.site_key;
                const options = {
                    sitekey: this.recaptchaKey,
                    callback: this.onCaptchaVerified,
                };
                const captchaLoginElement = this.$refs.captcha_login;
                if (!captchaLoginElement.hasAttribute('data-rendered')) {
                     try {
                        grecaptcha.render(captchaLoginElement, options);
                        this.$refs.captcha_login.setAttribute('data-rendered', 'true');
                    } catch (loginError) {
                        console.error('Ошибка при рендеринге reCAPTCHA для формы входа:', loginError);
                    }
                }
                if (!this.$refs.captcha_register.hasAttribute('data-rendered')) {
                    try {
                        grecaptcha.render(this.$refs.captcha_register, options);
                        this.$refs.captcha_register.setAttribute('data-rendered', 'true');
                    } catch (registerError) {
                        console.error('Ошибка при рендеринге reCAPTCHA для формы регистрации:', registerError);
                    }
                }

            } catch (error) {
                console.error('Ошибка при получении ключа reCAPTCHA:', error);
            }
        },
        onCaptchaVerified(response){
            this.captchaResponse = response;
        },  
        checkAuthentication() {
            axios.get('/user').then(response => {
                this.isAuthenticated = response.data.isAuthenticated;
            });      
        },
        closeModal(refs)
        {
            var modalLogin = this.$refs[refs];
            $(modalLogin).modal('hide');
            this.form.reset();
        },
        async login(){
            if(this.captchaResponse != null)
            {
                this.form.grecaptchaResponse = this.captchaResponse;
            }

            this.loading = true;
            this.form.post('/login')
            .then((response)=> {
                if(response.data.success){
                    this.message = response.data.message;
                    this.error = null;
                    this.isAuthenticated = true;
                    this.closeModal('modalLogin');
                } else {
                    this.error = response.data.message;
                    this.message = null;
                }
            }).finally(() => 
                this.loading = false,
                this.renderCaptcha(),
            )
        },
        logout()
        {
            axios.post('/logout').then(() => {
                this.isAuthenticated = false;
            });
        },
        register()
        {
            if(this.captchaResponse != null)
            {
                this.form.grecaptchaResponse = this.captchaResponse;
            }

            this.loading = true;
            this.form.post('/register')
            .then((response) => {
                if(response.data.success){
                    this.message = response.data.message;
                    this.error = null;
                    this.isAuthenticated = true;
                    this.closeModal('modaRegister');
                }else {
                    this.loading = false;
                    this.error = response.data.message;
                    this.message = null;
                }
            }).finally(() =>
                this.captchaResponse = null,
                this.loading = false,
                this.renderCaptcha(),
            )
        }

    },
  };

</script>