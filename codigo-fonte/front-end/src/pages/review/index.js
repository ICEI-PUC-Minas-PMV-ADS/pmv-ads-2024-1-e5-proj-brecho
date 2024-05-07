import { Container, Grid } from '@mui/material';
import React from 'react';
import { _mockDataProducts } from '../../_mocks/_dataItems';
import { Header } from "../../components/header";
import { ProductReview } from '../../components/productReview';


export const ReviewPage = () => {
  return (
    <main>
      <Header totalFavoriteItems={4} totalItemsShoppingCart={10} />
      <Container maxWidth="lg" sx={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
        <Grid container spacing={5} sx={{ height: '100vh', width: '100%', display: 'flex', gap: 5, alignItems: 'center', justifyContent: 'center' }} >
          <ProductReview product={_mockDataProducts[0]} userId={1} />
        </Grid>
      </Container>
    </main>
  )
};