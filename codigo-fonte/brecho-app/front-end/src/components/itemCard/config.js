import { TypesPage } from '../../pages/config';

export const ConfigCard = {
  title: {
    home: 'Página Inicial',
    'shopping-cart': 'Items do Carrinho de Compras',
    'favorite-items': 'Items Favoritados',
    'men': 'Moda Masculina',
    'women': 'Moda Feminina',
    'children': 'Moda Infantil',
  },
  omit: {
    addCartButton: (type) => {
      switch (type) {
        case TypesPage.shoppingCart:
          return true;
        default:
          return false;
      }
    }
  }
}
