import SentimentDissatisfiedIcon from '@material-ui/icons/SentimentDissatisfied';
import SentimentSatisfiedIcon from '@material-ui/icons/SentimentSatisfied';
import SentimentSatisfiedAltIcon from '@material-ui/icons/SentimentSatisfiedAltOutlined';
import SentimentVeryDissatisfiedIcon from '@material-ui/icons/SentimentVeryDissatisfied';
import SentimentVerySatisfiedIcon from '@material-ui/icons/SentimentVerySatisfied';
import Rating from '@material-ui/lab/Rating';
import PropTypes from 'prop-types';
import React, { useState } from 'react';
import { ContainerRating, ProductReviewForm, RatingLabel, ReviewDescriptionLabel, ReviewDescriptionTextarea, SubmitButton } from './styled';

export const ProductReview = ({ product, userId }) => {
  const [reviewDescription, setReviewDescription] = useState('');
  const [ratingSelected, setRatingSelected] = useState(1);

  const handleSubmit = (event) => {
    event.preventDefault();

    // Send the review data to the Laravel server using Inertia
    // Inertia.post('/products/reviews', {
    //   productId: product.id,
    //   userId,
    //   reviewDescription,
    //   rating: ratingSelected,
    // });
  };

  const customIcons = {
    1: {
      icon: <SentimentVeryDissatisfiedIcon style={{ fontSize: 35 }} />,
      label: 'Very Dissatisfied',
    },
    2: {
      icon: <SentimentDissatisfiedIcon style={{ fontSize: 35 }} />,
      label: 'Dissatisfied',
    },
    3: {
      icon: <SentimentSatisfiedIcon style={{ fontSize: 35 }} />,
      label: 'Neutral',
    },
    4: {
      icon: <SentimentSatisfiedAltIcon style={{ fontSize: 35 }} />,
      label: 'Satisfied',
    },
    5: {
      icon: <SentimentVerySatisfiedIcon style={{ fontSize: 35 }} />,
      label: 'Very Satisfied',
    },
  };

  function IconContainer(props) {
    const { value, ...other } = props;
    return <span {...other}>{customIcons[value].icon}</span>;
  }

  IconContainer.propTypes = {
    value: PropTypes.number.isRequired,
  };

  return (
    <div className="product-review-form">
      <ProductReviewForm onSubmit={handleSubmit}  >
        <h2 style={{ color: '#616161' }} >Cadastre sua Avaliação</h2>
        <RatingLabel htmlFor="rating">1° O que você achou desse produto?</RatingLabel>

        <ContainerRating>
          <Rating name="size-large" defaultValue={1} size="large" onChange={(rating) => setRatingSelected(rating)} />
        </ContainerRating>

        <ReviewDescriptionLabel htmlFor="reviewDescription">
          2° Por que você deu essa avaliação?
        </ReviewDescriptionLabel>

        <ReviewDescriptionTextarea
          id="reviewDescription"
          name="reviewDescription"
          value={reviewDescription}
          onChange={(event) => setReviewDescription(event.target.value)}
        />

        <SubmitButton type="submit">Enviar Avaliação</SubmitButton>
      </ProductReviewForm>
    </div>
  );
};
