import { ListItem, ListItemAvatar, ListItemText, Typography } from "@mui/material";
import { StyledReviewAvatar, StyledReviewDescription, StyledReviewRating } from './styled';

export const ReviewItem = ({ author, date, rating, description }) => {
  return (
    <ListItem sx={{ borderBottom: 'solid 1px #c3c3c3', width: '100%' }} >
      <ListItemAvatar>
        <StyledReviewAvatar>{author[0]}</StyledReviewAvatar>
      </ListItemAvatar>
      <ListItemText>
        <Typography variant="body1">{author}</Typography>
        <Typography variant="body2" color="textSecondary">
          {date}
        </Typography>
        <StyledReviewRating value={rating} readOnly />
        <StyledReviewDescription variant="body2">{description}</StyledReviewDescription>
      </ListItemText>
    </ListItem>
  );
};
