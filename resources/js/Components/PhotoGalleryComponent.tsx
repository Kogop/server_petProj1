import ImageGallery from "react-image-gallery";
// import stylesheet if you're not already using CSS @import
import "react-image-gallery/styles/css/image-gallery.css";
import { useState, useEffect } from "react";


export default function PhotoGalleryComponent() {


        const [images, setImages] = useState([]);
        
    
        useEffect(() => {
            const fetchImages = async () => {
              try {
                const response = await fetch('/images');
                const data = await response.json();
                console.log(data.images);
                setImages(data.images.map((item: string) => ({
                        "original" : item + "?w=164&h=164&fit=crop&auto=format&dpr=2 2x",
                        "thumbnail" : item + "?w=164&h=164&fit=crop&auto=format"
                    }))
                );
                
                
              } catch (error) {
                console.error('Error fetching images:', error);
              }
            };
        
            fetchImages();
          }, []);

    return <ImageGallery items={images} />;
}