// Filename - App.js

import axios from "axios";
import React, { Component } from "react";
import { Button } from "@headlessui/react";
import { usePage } from "@inertiajs/react";
import Button2 from '@mui/material/Button';
interface Istate {
    selectedFile: File | null
}

class FileUpload extends Component {
    // user = usePage().props.auth.user;
    state: Istate = {
        // Initially, no file is selected
        selectedFile: null
    };

    // On file select (from the pop up)
    onFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        if(event.target.files && event.target.files.length > 0){
            // Update the state
            this.setState({
                selectedFile: event.target.files[0]
            });
        }
    };

    // On file upload (click the upload button)
    onFileUpload = () => {
        // Create an object of formData
        const formData = new FormData();        

        // Update the formData object
        if (this.state.selectedFile) {
            formData.append(
                "userFile",
                this.state.selectedFile,
                this.state.selectedFile.name
            );
        }

        // Details of the uploaded file
        console.log(this.state.selectedFile);
        console.log(formData);
        

        // Request made to the backend api
        // Send formData object
        axios.post(route("photo_album_upload"), formData)
        .then(response => {
        
            console.log(response);
        })
        .catch(error => (error.response));

        
    };

    // File content to be displayed after
    // file upload is complete
    fileData = () => {
        if (this.state.selectedFile) {
            return (
                <div>
                    <h2>File Details:</h2>
                    <p>File Name: {this.state.selectedFile.name}</p>

                    <p>File Type: {this.state.selectedFile.type}</p>

                    <p>
                        Last Modified:
                        {new Date(this.state.selectedFile.lastModified).toDateString()}
                    </p>
                </div>
            );
        } else {
            return (
                <div>
                    <br />
                    <h4>Choose before Pressing the Upload button</h4>
                </div>
            );
        }
    };

    render() {
        return (
            <div>
                <h1>GeeksforGeeks</h1>
                <h3>File Upload using React!</h3>
                <div>
                    <input type="file" onChange={this.onFileChange} name="filename" />
                    <Button className="rounded bg-sky-600 py-2 px-4 text-sm text-white data-[hover]:bg-sky-500 data-[active]:bg-sky-700" onClick={this.onFileUpload}>Upload!</Button>
                    <Button2 variant="contained"  onClick={this.onFileUpload} >Upload with MUI Button!</Button2>
                </div>
                {this.fileData()}
            </div>
        );
    }
}

export default FileUpload;
