import { Card, CardMedia, Grid, ImageList, ImageListItem, Typography } from "@mui/material";
import { useState, useEffect } from "react";

export default function PhotoAlbumComponent() {


    
    // return (
    //     <div> da da ya</div>
    // );
    const [images, setImages] = useState([]);
    

    useEffect(() => {
        const fetchImages = async () => {
          try {
            const response = await fetch('/images');
            const data = await response.json();
            console.log(data.images);
            setImages(data.images);
            
            
          } catch (error) {
            console.error('Error fetching images:', error);
          }
        };
    
        fetchImages();
      }, []);
    //   sx={{ width: 500, height: 450 }}
      return (
        <>
        <ImageList sx={{ width: 1000, height: 450 }}  cols={3} rowHeight={164}>
            {images.map((item) => (
                <ImageListItem key={item}>
                <img
                    srcSet={`${item}?w=164&h=164&fit=crop&auto=format&dpr=2 2x`}
                    src={`${item}?w=164&h=164&fit=crop&auto=format`}
                    alt={item}
                    loading="lazy"
                />
                </ImageListItem>
            ))}
        </ImageList>
        {/* <Grid container spacing={2}>
        {images.map((imageUrl, index) => (
          <Grid item xs={12} sm={6} md={4} key={index}>
            <Card>
              <CardMedia
                component="img"
                height="140"
                image={imageUrl}
                alt={`Image ${index + 1}`}
              />
              <Typography gutterBottom variant="h5" component="div">
                Image {index + 1}
              </Typography>
            </Card>
          </Grid>
        ))}
      </Grid> */}
      </>
    );
    // return (
    //     <ImageList sx={{ width: 500, height: 450 }} cols={3} rowHeight={164}>
    //         {images.map((item) => (
    //             <ImageListItem key={item.id}>
    //             <img
    //                 srcSet={`storage/${item.file_path}?w=164&h=164&fit=crop&auto=format&dpr=2 2x`}
    //                 src={`storage/${item.file_path}?w=164&h=164&fit=crop&auto=format`}
    //                 alt={item.user_file_name}
    //                 loading="lazy"
    //             />
    //             </ImageListItem>
    //         ))}
    //     </ImageList>
    // );
}
