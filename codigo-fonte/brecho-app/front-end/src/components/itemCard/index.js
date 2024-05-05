import FavoriteIcon from '@mui/icons-material/Favorite';
import DetalhesIcon from '@mui/icons-material/Info';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import React from 'react';
import { TypesPage } from '../../pages/config';
import { StyledCard } from './styled';

import {
  Box,
  Button,
  CardActions,
  CardContent,
  CardMedia,
  IconButton,
  Rating,
  Tooltip,
  Typography
} from '@mui/material';
import { ConfigCard } from '../itemCard/config';

export const ItemCard = ({ product, userId, typePage }) => {


  const addShoppingCart = async (productId) => {
    try {
      const data = {
        productId,
        userId,
      };
    } catch (error) {
      console.error(error);
    }
  };


  const addFavoriteItem = async (productId) => {
    try {
      const data = {
        productId,
        userId,
      };
    } catch (error) {
      console.error(error);
    }
  };

  const changeItemDetailsPage = () => { };

  return (
    <StyledCard key={product.id} sx={{ backgroundColor: '#fcf4e4', display: typePage === TypesPage.infoItem ? 'flex' : 'initial' }} >
      <CardMedia
        component="img"
        image={product.image}
        alt={product.name}
        height={typePage === TypesPage.infoItem ? 400 : 200}
      />
      <Box sx={{  display: 'flex', flexDirection: 'column', justifyContent: 'space-between' }} >
        <CardContent sx={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', flexDirection: 'column', flex: 1 }} >
          <Typography variant="h2" fontSize="1.7rem" gutterBottom>{product.name}</Typography>
          
          {
            typePage === TypesPage.infoItem && (
              <Typography variant="body1" fontSize="1.1rem" gutterBottom>{product.description}</Typography>
            )
          }

        <Box mt={2}>
          <Rating value={product.rating} readOnly size="medium" />
        </Box>

        <Box>
          <Tooltip title={product.isFavorited ? "Desfavoritar o Item" : 'Favoritar o Item'} >
            <IconButton onClick={() => {
              addFavoriteItem(product.id)
            }}>
              <FavoriteIcon color={product.isFavorited ? 'error' : 'inherit'} />
            </IconButton>
          </Tooltip>
          <Tooltip title="Ver Detalhes" >
            <IconButton onClick={changeItemDetailsPage}>
              <DetalhesIcon />
            </IconButton>
          </Tooltip>
        </Box>
      </CardContent>
      {
        !ConfigCard.omit.addCartButton(typePage) && (
          <CardActions sx={{ display: 'flex', justifyContent: 'center' }} >
            <Button
              onClick={() => {
                addShoppingCart(product.id)
              }}
              variant="outlined"
              color='warning'
              endIcon={<ShoppingCartIcon />}
              sx={{ width: 'auto' }}
            >
              Adicionar ao Carrinho
            </Button>
          </CardActions>
        )
      }
    </Box>
    </StyledCard >
  )
};  