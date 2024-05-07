import { MenuItem } from "@mui/material";
import styled from "styled-components";

export const ButtonReturn = styled(MenuItem)`
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