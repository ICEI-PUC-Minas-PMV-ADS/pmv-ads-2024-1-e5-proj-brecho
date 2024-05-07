import { Box, Container, Grid, Typography } from '@mui/material';
import React from 'react';
import { _mockDataProducts } from '../../_mocks/_dataItems';
import { Header } from "../../components/header";
import { ItemCard } from '../../components/itemCard';
import { TypesPage } from '../config';

export const FavoriteItemsPage = () => {
  return (
    <main>
      <Header totalFavoriteItems={4} totalItemsShoppingCart={10} />
      <Container maxWidth="lg" sx={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
        <Box>
          <Typography variant='h1' sx={{ fontSize: '2rem' }} >
            Itens Favoritados
          </Typography>
        </Box>
        <Grid container spacing={5} sx={{ display: 'flex', gap: 5, alignItems: 'center', justifyContent: 'center' }} >
          {_mockDataProducts.map((product) => (
            <>
              {
                product.isFavorited && (
                  <ItemCard key={product.id} product={product} typePage={TypesPage.favoriteItems} userId={1} />
                )
              }
            </>
          ))}
        </Grid>
      </Container>
    </main>
  )
};