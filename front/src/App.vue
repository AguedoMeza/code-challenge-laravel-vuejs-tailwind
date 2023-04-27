
<script setup lang="ts">
</script>

<template>

<div  class="fixed z-10 inset-0 overflow-y-auto" v-show="showModal" @click.self="cerrarModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <div class="inline-block align-bottom  justify-center bg-white rounded-lg text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white justify-center px-5 pt-5 pb-5 sm:p-4 sm:pb-4">
          <div class="sm:block sm:items-start px-3 pt-3">
            <div class="mt-3 text-center justify-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900">{{ title }}</h3>
              <div>
                <form @submit.prevent="createContact"  id="formContacts" novalidate>
                  <div class="pt-4 " >
                        <label 
                        for="first_name" 
                        class="block text-sm font-medium text-grey-700">
                        First Name: </label>
                        <input 
                          type="text"
                          v-model="newContact.first_name"
                          id="first_name"
                          class="mt-2 shadow appearance-none border rounded w-full py-1 px-1 text-gery-600 leading-tight focus:outline-none focus:shadow-outline"
                          placeholder="First Name"
                          required
                          maxlength="50"
                          />   
                          <p class="error-message text-red-700 font-light text-sm" v-if="!newContact.first_name"> The FirstName field is required  </p>
                          
                      </div>
                  <div class="pt-4">
                        <label 
                        for="last_name" 
                        class="block text-sm font-medium text-grey-700">
                        Last Name: </label>
                        <input 
                          type="text"
                          v-model="newContact.last_name"
                          class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gery-600 leading-tight focus:outline-none focus:shadow-outline"
                          placeholder="Last Name"
                          required
                          maxlength="50"
                          />
                          <p class="error-message text-red-700 font-light text-sm" v-if="!newContact.last_name"> The LastName field is required </p>
                      </div>
                      <div class="pt-4">
                        <label 
                        for="phone" 
                        class="block text-sm font-medium text-grey-700">
                        Phone: </label>
                        <input 
                          type="text"
                          v-model="newContact.phone"
                          class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gery-600 leading-tight focus:outline-none focus:shadow-outline"
                          placeholder="Phone"
                          required
                          pattern="[0-9]{10}"
                          maxlength="20"
                          />
                      </div>
                      <div class="pt-4">
                        <label 
                        for="email" 
                        class="block text-sm font-medium text-grey-700">
                        Email: </label>
                        <input 
                          type="email"
                          v-model="newContact.email"
                          class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gery-600 leading-tight focus:outline-none focus:shadow-outline"
                          placeholder="Email"
                          required
                          maxlength="100"
                          />
                          <p class="error-message text-red-700 font-light text-sm" v-if="newContact.email && !validarEmail()">A valid email is required</p>
                      </div>
                      <div class="pt-4  " >
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                          @click.prevent="guardarContacto">
                           {{ modoEdicion ? 'Update' : 'Save' }}
                       </button>
                      </div>
                </form >
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button 
          type="button" 
          class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" @click="showModal=false">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>


 <div class="sm:px-1 sm:py-1 lg:px-20 lg:py-20 ">

  <div class="flex justify-end mt-4">
  <button 
  type="button" 
  class="inline-block rounded bg-white px-4 pb-2 pt-2 text-xs font-medium uppercase leading-normal text-neutral-800  transition duration-150 ease-in-out hover:bg-neutral-100 focus:bg-neutral-100 focus:outline-none focus:ring-0 active:bg-neutral-200 " 
  @click="showLoginModal = true">
    Login
  </button>
  <button 
  type="button" 
  class="inline-block rounded bg-white px-4 pb-2 pt-2 text-xs font-medium uppercase leading-normal text-neutral-800  transition duration-150 ease-in-out hover:bg-neutral-100 focus:bg-neutral-100 focus:outline-none focus:ring-0 active:bg-neutral-200 "
  @click="logout()">
    Logout
  </button>
</div>

  <div class=" flex flex-col justify-rigth sm:px-1 sm:py-2 lg:px-40 bg-white">
    <div class="  text-center  ">
      <h1 class="  text-4xl font-bold text-grey-900 "> My Contacts </h1>
      <p class=" text-xl text-gery-700 pt-4"> CREATE CONTACT LIST </p>
    </div>
  
    <div class="flex flex-col  justify-rigth lg:py-4 sm:py-1">
      <div class="flex justify-end items-center" >
        <button v-if="isLoggedIn" @click="showModal = true;  this.newContact = {}; this.modoEdicion = false;" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
           Add Contact
        </button>
        <button v-else @click="showLoginModal = true" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Log in to add a contact
        </button>
    </div>
    </div>
    <div class="container mx-auto pt-9">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
          <th scope="col" class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
          <th scope="col" class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
          <th scope="col" class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">email</th>
          <th scope="col" class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit</th>
          <th scope="col" class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delete</th>
        </tr>
      </thead>
      <tbody v-if="contacts.length > 0" class="bg-white divide-y divide-gray-200">
      <tr v-for="(contact, index) in contacts" :key="index">
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ contact.first_name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ contact.last_name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ contact.phone }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ contact.email }}</td>
        <td class="px-6 py-4 text-right">
          <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click.prevent="editarContacto(contact)">Edit</a>
        </td>
        <td class="px-6 py-4 text-right">
            <a href="#"  @click="showConfirmDelete(contact.uuid)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
        </td>
      </tr>
    </tbody>
    </table>
  </div>
  </div>

 </div>


<div class="fixed z-10 inset-0 overflow-y-auto" v-show="showLoginModal" @click.self="showLoginModal = false">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showLoginModal = false; showAuthError = false">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div class="inline-block align-bottom bg-white rounded-lg text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="text-center sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Login</h3>
            <div class="mt-2">
              <form>
                <div v-if="showAuthError" class="text-red-500   text-xs  mt-2">Authentication error. Please log in again.</div>
                <div>
                  <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                  <input 
                  v-model="login.email"
                  type="text" 
                  name="username" 
                  id="username" 
                  autocomplete="username" 
                  class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  >
                </div>

                <div class="mt-4">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input 
                  v-model="login.password"
                  type="password" 
                  name="password" 
                  id="password" 
                  autocomplete="current-password" 
                  class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button 
        type="button" 
        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" 
        @click="iniciarSesion"
        >
          Login
        </button>
      </div>
    </div>
  </div>
</div>
 
</template>

<script>
import axios from 'axios';




export default {

 
  data() {
    return {
      isLoggedIn: false,
      showAuthError: false,
      showLoginModal: false,
      first_name: '',
      botonDesactivado: false,
      firstNameError: null,
      emailError: '',
      modoEdicion: false,
      showModal: false,
      contactoSeleccionado: null,
      contactoSeleccionadoId: null,
      contacts: [],
      newContact: {
        first_name: '',
        last_name: '',
        phone: '',
        email: ''
      },
    
      login: {
        email: '',
        password: ''
      }
    }
  },

  props: {
    title: {
      type: String,
      default: 'Modal'
    },
    show: {
      type: Boolean,
      default: false
    }
  },
  mounted() {
    const token = localStorage.getItem("token");
    if (token) {
      this.isLoggedIn = true;
    }
    this.fetchContacts();
  },
  methods: {

    handleErroLogin(error) {
      if (error.response && error.response.status === 401) {
        this.showAuthError = true;
        this.showLoginModal = true;
        this.contacts = [];
      } else {
        console.log(error);
      }
    },

    logout() {
      localStorage.removeItem('token');
      this.contacts = [];
      this.isLoggedIn = false
    },

    iniciarSesion() {
      axios.post(`${import.meta.env.VITE_CONTACTS_API}/login`, this.login, {
        
      })
      .then(response => {
        localStorage.setItem('token', response.data.token);

        this.isLoggedIn = true;
        this.showLoginModal = false;
        this.showAuthError = false;
        this.login.email = '';
        this.login.password = '';
        this.fetchContacts();
     
      })
      .catch(error => {
         this.handleErroLogin(error);
      });
    },

    fetchContacts() {
    
      axios.get(`${import.meta.env.VITE_CONTACTS_API}/contacts`, {
        headers: {
            Authorization: localStorage.getItem('token')
          }
      })
        .then(response => {
          this.contacts = response.data.data;
        })
        .catch(error => {
          console.log(error);
        })
    },
    cerrarModal() {
    this.showModal = false;
    this.modoEdicion = false;
  },
  validarEmail() {
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(this.newContact.email)) {
      return false;
    } else {
      return true;
    }
  },
    openModal() {
      this.showModal = true
    },
    createContact() {
      axios.post(`${import.meta.env.VITE_CONTACTS_API}/contacts`, this.newContact, {
        headers: {
            Authorization: localStorage.getItem('token')
          }
      })
        .then(response => {
          this.newContact.first_name = '';
          this.newContact.last_name = '';
          this.newContact.phone = '';
          this.newContact.email = '';
          this.fetchContacts();
          this.showModal = false
        })
        .catch(error => {
          console.log(error);
        })
    },
    guardarContacto() {
      console.log("mensaje "+this.modoEdicion);
      if (this.validarCampo()) {
    if (this.modoEdicion) {
      this.actualizarContacto();
    } else {
      this.createContact();
    }
  }
    },

   
    validarCampo() {
  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  const nombreValido = !!this.newContact.first_name && !!this.newContact.last_name;
  const correoValido = !this.newContact.email || regex.test(this.newContact.email);
  if (!nombreValido || !correoValido) {
    return false;
  }
  return true;
},
    
    showConfirmDelete(id) {
    if (window.confirm("Are you sure you want to delete this contact?")) {
      this.deleteContact(id);
    }
     },

    deleteContact(id) {
      axios.delete(`${import.meta.env.VITE_CONTACTS_API}/contacts/${id}`, {
        headers: {
            Authorization: localStorage.getItem('token')
          }
      })
      .then(response => {
        this.fetchContacts();
      })
      .catch(error => {
        console.log(error);
        if (error.response.status === 403) {
          this.showLoginModal = true;
        }
      });
    },
    editarContacto(contact) {
    this.contactoSeleccionado = { ...contact };
    this.contactoSeleccionadoId = contact.uuid
    this.newContact.first_name = contact.first_name
    this.newContact.last_name = contact.last_name
    this.newContact.phone = contact.phone
    this.newContact.email = contact.email
    this.showModal = true
    this.modoEdicion = true;
  },
  actualizarContacto() {
  console.log('Datos enviados:', this.newContact);
  if (this.contactoSeleccionadoId) { // usamos una variable separada para guardar el ID del contacto seleccionado
    axios.put(`${import.meta.env.VITE_CONTACTS_API}/contacts/${this.contactoSeleccionadoId}`, JSON.stringify(this.newContact), {
      headers: {
        'Content-Type': 'application/json',
        Authorization: localStorage.getItem('token')
      }
    })
    .then(response => {
      this.fetchContacts();
      this.showModal = false
      this.modoEdicion = false;
      this.newContact = {}; 
    })
    .catch(error => {
      console.error(error)
    })
  }
},







    

  }
}
</script>


