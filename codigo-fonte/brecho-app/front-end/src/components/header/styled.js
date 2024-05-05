import { styled } from '@mui/material/styles';

import {
  AppBar,
  IconButton,
  Menu,
  MenuItem,
  Toolbar,
  Typography
} from '@mui/material';

// Estilos dos elementos do header
export const StyledHeader = styled(AppBar)`
  background-color: #f8f4e3;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1rem;
  display: flex;
  align-items: center;

`;

export const StyledToolbar = styled(Toolbar)`
  display: flex;
  width: 95%;
  justify-content: space-between;
  align-items: center;
`;

export const StyledLogo = styled(Typography)`
  font-family: 'Raleway', sans-serif;
  font-size: 1.6rem;
  font-weight: bold;
  /* color: #007bff; */
  text-decoration: none;
  
  @media (max-width: 768px) {
    font-size: 1.2rem;
  }
`;

export const StyledFavoriteIconButton = styled(IconButton)`
  color: #dc3545;
  margin-left: 20px;
`;

export const StyledMenuIconButton = styled(IconButton)`
  color: #727068;
  display: none;
  align-items: center;
  justify-content: center;
`;

export const StyledMenu = styled(Menu)`
  & .MuiMenu-paper {
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }
`;

export const StyledMenuItem = styled(MenuItem)`
  font-family: 'Raleway', sans-serif;
  font-size: 15px;
  color: #000;
  padding: 5px 15px;
  text-decoration: none;

  transition: all .3s ease;

  &:hover {
    background-color: #e5a11960;
    color: #89600f;
    border-radius: 15px;
  }
`;
