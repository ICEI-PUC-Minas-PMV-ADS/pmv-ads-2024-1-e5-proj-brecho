import { Box, Container, Grid, Typography } from '@mui/material';
import React from 'react';
import { _mockDataProducts } from '../../_mocks/_dataItems';
import { _mockReviews } from '../../_mocks/_reviews';
import { Header } from "../../components/header";
import { ItemCard } from '../../components/itemCard';
import { ReviewList } from '../../components/reviewList';
import { TypesPage } from '../config';
import { ButtonReturn } from './styled';

const _mockProduct = _mockDataProducts[0];

export const InfoPage = () => {

  const changeReturnPage = () => {};
  
  return (
    <main>
      <Header totalFavoriteItems={4} totalItemsShoppingCart={10} />
      <Container maxWidth="lg" sx={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
        <Box sx={{ display: 'flex', flexDirection: 'column', gap: 2 }} >
          <Box sx={{ display: 'flex', gap: '10px', }} >
            <ButtonReturn onClick={changeReturnPage}>Voltar</ButtonReturn>
          </Box>
          <Typography variant='h1' sx={{ fontSize: '2rem' }} >
            Detalhes do Item
          </Typography>
        </Box>
        <Grid container spacing={5} sx={{ display: 'flex', gap: 5, alignItems: 'center', justifyContent: 'center' }} >
          <ItemCard key={_mockProduct.id} product={_mockProduct} typePage={TypesPage.infoItem} userId={1} />
        </Grid>
        <Grid container spacing={5} sx={{ display: 'flex', gap: 5, alignItems: 'center', }} >
          <ReviewList reviews={_mockReviews} />
        </Grid>
      </Container>
    </main>
  )
};