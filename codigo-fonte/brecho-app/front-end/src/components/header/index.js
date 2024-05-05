import FavoriteIcon from '@mui/icons-material/Favorite';
import MenuIcon from '@mui/icons-material/Menu';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import { Badge, Box, IconButton, Tooltip } from '@mui/material';
import React, { useState } from 'react';
import { StyledFavoriteIconButton, StyledHeader, StyledLogo, StyledMenu, StyledMenuIconButton, StyledMenuItem, StyledToolbar } from './styled';

export const Header = ({ totalFavoriteItems, totalItemsShoppingCart }) => {
  const [anchorEl, setAnchorEl] = useState(null);

  const handleMenuOpen = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleMenuClose = () => {
    setAnchorEl(null);
  };

  const changeShoppingCartPage = () => {};
  const changeFavoriteItemPage = () => {};
  
  const changeHomePage = () => {
    handleMenuClose();
  };
  
  const changeMenPage = () => {
    handleMenuClose();
  };
  
  const changeWomenPage = () => {
    handleMenuClose();
  };
  
  const changeChildrenPage = () => {
    handleMenuClose();
  };

  return (
    <Box height={120} >
      <StyledHeader>
        <StyledToolbar>
          <Box sx={{ display: { sm: 'block' } }}>
            <StyledLogo component="a" href="/">
              Renova Brechó
            </StyledLogo>
          </Box>
          <StyledMenu
            id="simple-menu"
            anchorEl={anchorEl}
            keepMounted
            open={Boolean(anchorEl)}
            onClose={handleMenuClose}
          >
            <StyledMenuItem onClick={changeHomePage}>Home</StyledMenuItem>
            <StyledMenuItem onClick={changeMenPage}>Homens</StyledMenuItem>
            <StyledMenuItem onClick={changeWomenPage}>Mulheres</StyledMenuItem>
            <StyledMenuItem onClick={changeChildrenPage}>Crianças</StyledMenuItem>
          </StyledMenu>
          <Box sx={{ display: { sm: 'flex', xs: 'none' }, gap: '10px', }} >
            <StyledMenuItem onClick={changeHomePage}>Home</StyledMenuItem>
            <StyledMenuItem onClick={changeMenPage}>Homens</StyledMenuItem>
            <StyledMenuItem onClick={changeWomenPage}>Mulheres</StyledMenuItem>
            <StyledMenuItem onClick={changeChildrenPage}>Crianças</StyledMenuItem>
          </Box>
          <Box sx={{ display: 'flex', gap: '20px', alignItems: 'center', justifyContent: 'center' }} >
            <Badge badgeContent={totalFavoriteItems} color="error">
              <IconButton onClick={changeFavoriteItemPage} className={StyledFavoriteIconButton}>
                <Tooltip title="Itens Favoritados" >
                  <FavoriteIcon color='inherit' />
                </Tooltip>
              </IconButton>
            </Badge>
            <Badge badgeContent={totalItemsShoppingCart} color="error">
              <IconButton onClick={changeShoppingCartPage} className={StyledFavoriteIconButton}>
                <Tooltip title="Itens no Carrinho" >
                  <ShoppingCartIcon />
                </Tooltip>
              </IconButton>
            </Badge>
            <StyledMenuIconButton sx={{ display: { sm: 'none', xs: 'flex' } }} onClick={handleMenuOpen}>
              <MenuIcon />
            </StyledMenuIconButton>
          </Box>
        </StyledToolbar>
      </StyledHeader>
    </Box>
  );
}
