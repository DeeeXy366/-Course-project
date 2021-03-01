let app = new Vue ({
  el : "#app",
  data:{
    change: true,
    dell: true,
    id: 0,
    id_cha: 0,
  },
  methods:{
    delp: function(){
      this.change = false;
      this.dell = false;
    },
    cha: function(){
      this.change = false;
      this.dell = false;
    },
    cha_click: function(){
      this.dell = true;
      this.change = true;
      this.id_cha = 0;
    },
    delp_click: function(){
      this.change = true;
      this.dell = true;
      this.id = 0;
    },
  }
})
