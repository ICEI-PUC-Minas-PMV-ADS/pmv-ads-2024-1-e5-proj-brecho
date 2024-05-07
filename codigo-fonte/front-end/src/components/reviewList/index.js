import { List, Typography } from "@mui/material";
import { ReviewItem } from '../reviewItem/';


export const ReviewList = ({ reviews }) => {
  return (
    <List sx={{ display: 'flex', flexDirection: 'column', width: '100%', gap: 3 }} >
      <Typography variant="h3" sx={{  fontSize: '1.7rem' }} >
        Avaliações
      </Typography>
      {reviews.map((review) => (
        <ReviewItem key={review.id} {...review} />
      ))}
    </List>
  );
};
