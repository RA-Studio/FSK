<template>
  <div class="content">
    <div class="lk">
      <div class="container">
        <h2 class="h1 title">Личный кабинет</h2>
        <div class="lk-items">
          <div class="lk-items-card" v-for="(item, key) in list" @click="setUrl(item.link)">
            <div class="lk-items-card-info">
              <div class="lk-items-card-info__title">
                <img :src="item.icon" :alt="item.title">{{item.title}}
              </div>
              <div class="lk-items-card-info__text">{{item.description}}</div>
              <div class="lk-items-card-info__btn btn-new btn--transp">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 1.52344C5.03738 1.52344 1 5.56082 1 10.5234C1 15.4861 5.03738 19.5234 10 19.5234C14.9626 19.5234 19 15.4861 19 10.5234C19 5.56082 14.9626 1.52344 10 1.52344ZM10 0.523438C15.5228 0.523438 20 5.00059 20 10.5234C20 16.0463 15.5228 20.5234 10 20.5234C4.47715 20.5234 0 16.0463 0 10.5234C0 5.00059 4.47715 0.523438 10 0.523438Z" fill="#F35E41"/><path d="M11.1191 13.2874L13.8711 10.5354L11.1191 7.78735" stroke="#F04B2F" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.71924 10.5483H13.5452" stroke="#F04B2F" stroke-linecap="round"/></svg>
                {{item.btm ? item.btm : 'Подробнее'}}
              </div>
            </div>
            <div class="lk-items-card__img">
              <img :src="item.src" :alt="item.title" style="object-position: 85% center">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
    import Vue from 'vue'
    export default {
        data () {
          return {
            list: {
              0: {
                page: 'basket',
                title: 'Моя сделка',
                icon: `${this.$store.state.locationImg}/lk-deal-icon.svg`,
                src: `${this.$store.state.locationImg}/lk-deal.jpg`,
                description: 'Здесь находится информация о вашем бронировании и интерфейс продолжения оформления сделки онлайн',
                btm: 'Подробнее',
                link: '/lk/basket/',
              },
              1: {
                page: 'details',
                title: 'Мои данные',
                icon: `${this.$store.state.locationImg}/lk-data-icon.svg`,
                src: `${this.$store.state.locationImg}/auth.jpg`,
                description: 'Управление информацией о вашем аккаунте: контакты, документы и т.д.',
                link: '/lk/details/',
              },
              2: {
                page: 'faq',
                title: 'Помощь и инфо',
                icon: `${this.$store.state.locationImg}/lk-faq-icon.svg`,
                src: `${this.$store.state.locationImg}/lk-faq.jpg`,
                description: 'Появились вопоосы? Здесь вы найдете ответы и контакты наших специалистов',
                link: '/lk/faq/',
              }
            }
          }
        },
        created() {},
        updated() {},
        components: {},
        computed: {},
        methods: {
          setUrl(page) {
            history.pushState(null, null, page);
            history.pushState(null, null, page);
            history.back();
          },
        },
    };
</script>