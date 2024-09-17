import { reactive } from "vue";

export const store = reactive({
  restaurants: [],
  category: [],
  selectedCategories: [],
  categories: [
    {
      id: "1",
      name: "Pizza",
      img: "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Eq_it-na_pizza-margherita_sep2005_sml.jpg/640px-Eq_it-na_pizza-margherita_sep2005_sml.jpg",
    },
    {
      id: "2",
      name: "Panini",
      img: "https://t3.ftcdn.net/jpg/03/31/97/12/360_F_331971297_a2OcoeyBd60z9chPmBAc7CppmjnNSxms.jpg",
    },
    {
      id: "3",
      name: "Sushi",
      img: "https://static.gamberorosso.it/2022/02/sushi-2-768x512.jpeg",
    },
    {
      id: "4",
      name: "Cinese",
      img: "https://academy.funnyveg.com/wp-content/uploads/2024/05/cucina_cicne_vegan.jpg",
    },
    {
      id: "5",
      name: "Vegetariano",
      img: "https://www.latanadimagilla.it/wp-content/uploads/2020/12/cucina-vegetariana.jpg",
    },
    {
      id: "6",
      name: "Dolci",
      img: "https://media-assets.lacucinaitaliana.it/photos/6273ee26a5c220068f7ca7aa/3:2/w_1500,h_1000,c_limit/torta-morbida-con-ganache-al-gianduia.jpg",
    },
  ],
});
