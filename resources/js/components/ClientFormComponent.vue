<template>
    <div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="phone-field">Номер телефону</label>
          <input type="text" id="phone-field" name="phone" v-model="phone" class="form-control" @blur=" complete( )" required>
        </div>
        <div class="form-group col-md-4">
          <label for="fio-field">ФІО</label>
          <input id="fio-field" type="text" name="fio" v-model="fio" class="form-control" required>
        </div>
        <div class="form-group col-md-4">
          <label for="email-field">E-mail</label>
          <input id="email-field" type="email" name="email" v-model="email" class="form-control" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="city-field">Місто</label>
          <input id="city-field" type="text" name="city" v-model="city" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
          <label for="adress-field">Вулиця / будинок</label>
          <input id="adress-field" type="text" name="adress" v-model="adress" class="form-control" required>
        </div>
      </div>
    </div>  
</template>

<script>
    import Inputmask from 'inputmask';
    export default {
        data: function(){
          return {
            phone: '',
            fio: '',
            city: '',
            adress: '',
            email: '',
          }
        },
        props: {
          mask: { type: String }
        },
        methods: {
          complete () {
            if ( this.phone.length >= 18 ) {
              axios.get('/clientSearch/' + this.phone).then( (response) => {
                      console.log(response.data);
                      this.email = response.data['email'];
                      this.fio = response.data['fio'];
                      this.adress = response.data['adress'];
                      this.city = response.data['city'];
                  });              
            }
          }
        },
        mounted() {
            console.log('Component mounted.')
            var im = new Inputmask("+38(999) 999 99 99");
            im.mask(document.getElementById('phone-field'));
        }
    }
</script>
