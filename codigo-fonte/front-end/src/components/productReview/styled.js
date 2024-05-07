import styled from 'styled-components';

export const ProductReviewForm = styled.form`
  display: flex;
  flex-direction: column;
  width: 500px;
  margin: 0 auto;
  padding: 20px;
  /* border: 1px solid #ccc; */
  border-radius: 5px;
  
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);

  background-color: #f8f4e3;
`;

export const RatingLabel = styled.label`
  display: block;
  margin-bottom: 5px;
`;

export const RatingInput = styled.input`
  width: 100px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
`;

export const ReviewDescriptionLabel = styled.label`
  display: block;
  width: 100%;
  margin-top: 10px;
  margin-bottom: 5px;
`;

export const ReviewDescriptionTextarea = styled.textarea`
  width: 100%;
  max-width: 485px;
  min-width: 485px;

  background-color: #c3c3c350;

  height: 100px;
  min-height: 100px;
  max-height: 100px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
`;

export const SubmitButton = styled.button`
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: solid 2px transparent;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  margin-top: 10px;
  transition: all 0.3s;

  &:hover {
    background-color: transparent;
    border: solid 2px #007bff;
    color: #007bff;
  }
`;

export const ContainerRating = styled.div`
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;

  gap: 10px;

  margin-top: 30px;
  margin-bottom: 30px;
`;

export const RatingButtons = styled.button`

  border: solid 2px black;
  border-radius: 5px;
  padding: 5px 10px;

  cursor: pointer;

  &:hover {
    background-color: #007bff;
    color: #ffffff;
  }
`;