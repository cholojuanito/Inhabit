<template>
<div>
    <div class="modal is-active">
        <div class="modal-background" @click="closePopup"></div>
        <div class="modal-content">
            <div class="box">
                <div class="title">Edit Listing at <span v-text="this.listing.street_address"></span></div>
                <hr>

                <form class="form-horizontal" method="POST" :action="patchURL" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="PATCH">
                    <p class="subtitle">
                        Manager/Contact Info
                    </p>
                    <div class="field">
                        <label for="contact_name" class="label">Name</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="input" id="contact_name" name="contact_name" v-model="form.contact_name" placeholder="John Smith">
                            <strong class="help is-danger" v-if="form.errors.has('contact_name')">Please enter a valid contact name</strong>
                        </div>
                    </div>

                    <div class="field">
                        <label for="contact_email" class="label">Email</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" class="input" id="contact_email" name="contact_email" v-model="form.contact_email" placeholder="john@smith.net">

                            <strong class="help is-danger" v-if="form.errors.has('contact_email')">Pleaes enter a valid emal address</strong>
                        </div>
                    </div>

                    <div class="field">
                        <label for="contact_phone" class="label">Phone Number</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fa-phone"></i>
                            </span>
                            <input type="text" class="input" id="contact_phone" name="contact_phone" v-model="form.contact_phone" placeholder="(800) 123-4567">
                            <strong class="help is-danger" v-if="form.errors.has('contact_phone')">Please enter a valid phone number for the US</strong>
                        </div>
                    </div>

                    <hr>
                    <p class="subtitle">
                        Apartment Info
                    </p>
                    <div class="field">
                    <label for="street_address" class="label">Street Address</label>
                        <div class="control">
                            <input id="street_address" type="text" class="input" name="street_address" v-model="form.street_address" placeholder="123 Main St"> 
                            <strong class="help is-danger" v-if="form.errors.has('street_address')">Pleaes enter a valid street address</strong>
                        </div>                     
                    </div>

                    <div class="field">
                        <label for="apt_num" class="label">Apt #</label>

                        <div class="control">                        
                            <input id="apt_num" type="text" class="input" name="apt_num" v-model="form.apt_num" placeholder="36, #36, etc..."> 
                            <strong class="help is-danger" v-if="form.errors.has('apt_num')"></strong>
                            <p class="help">* Optional</p>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-body">

                            <div class="field">
                                <label for="city" class="label">City</label>
                                <div class="control">                        
                                    <input id="city" type="text" class="input" name="city" v-model="form.city" placeholder="Manhattan, Sacramento, etc...">
                                    <strong class="help is-danger" v-if="form.errors.has('city')">Please enter a valid city</strong>
                                </div>
                            </div>

                            <div class="field">
                                <label for="state" class="label">State</label>
                                <div class="control">
                                    <div class="select">
                                        <select id="state" name="state" v-model="form.state">
                                            <option v-for="state in states" :key="state" :value="state"><span v-text="state"></span></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-body">

                            <div class="field">
                                <label for="date_available" class="label">Availability Date</label>
                                <div class="control">
                                    <input type="date" class="input" id="date_available" name="date_available" v-model="form.date_available">
                                    <strong class="help is-danger" v-if="form.errors.has('date_available')">Please enter a valid date</strong>
                                </div>
                            </div>

                            <div class="field is-expanded">
                                <label for="monthly_price" class="label">Monthly Rate</label>
                                <div class="field has-addons">
                                    <p class="control">
                                        <a class="button is-static">
                                            $
                                        </a>
                                    </p>
                                    <p class="control is-expanded">
                                        <input class="input" type="number" name="monthly_price" v-model="form.monthly_price" min="1">
                                    </p>
                                </div>
                                    <strong class="help is-danger" v-if="form.errors.has('monthly_price')">Please enter a valid price</strong>
                                    <p class="help">Must be greater than zero.</p>
                            </div>

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-body">

                            <div class="field">
                                <label for="num_beds" class="label"># of Beds</label>
                                <div class="control">
                                    <input type="number" class="input" id="num_beds" name="num_beds" v-model="form.num_beds" step="0.5" min="0.5" max="20">
                                    <strong class="help is-danger" v-if="form.errors.has('num_beds')">Please enter a valid number</strong>
                                </div>
                            </div>

                            <div class="field">
                                <label for="num_baths" class="label"># of Baths</label>
                                <div class="control">
                                    <input type="number" class="input" id="num_baths" name="num_baths" v-model="form.num_baths" step="0.5" min="0.5" max="20">
                                    <strong class="help is-danger" v-if="form.errors.has('num_baths')">Please enter a valid number</strong>
                                </div>
                            </div>

                            <div class="field">
                                <label for="square_ft" class="label">Square Feet</label>
                                <div class="control">
                                    <input type="number" class="input" id="square_ft" name="square_ft" v-model="form.square_ft" min="0" placeholder="1000">
                                    <strong class="help is-danger" v-if="form.errors.has('square_ft')">Please enter a valid number</strong>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="field">
                        <label for="description" class="label">Brief Description</label>

                        <div class="description">                        
                            <textarea id="description" class="textarea" name="description" v-model="form.description"></textarea>
                            <strong class="help is-danger" v-if="form.errors.has('description')">Please enter a brief description</strong>
                        </div>
                    </div>

                    <div class="field is-grouped is-left">
                        <div class="control">
                            <button type="submit" class="button is-link" :disabled="form.errors.any()">
                                Save Changes
                            </button>
							<button class="button is-light" @click="closePopup">Discard</button>
                        </div>
                    </div>
                </form>
                <br>
                <p class="title">Upload Images</p>
                <vue-dropzone id="dropzone" 
                    :options="dropzoneOptions"
                    @vdropzone-sending="editRequest"
                    @vdropzone-sending-multiple="editRequest"        
                ></vue-dropzone>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" @click="closePopup"></button>
    </div>
</div>
</template>

<script>
//import MultipleImageUpload from './uploads/MultipleImageUpload.vue'
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.css";
export default {
  props: ["listing"],

  components: { VueDropzone: vue2Dropzone },

  data() {
    return {
      form: new Form({
        contact_name: this.listing.contact_name,
        contact_email: this.listing.contact_email,
        contact_phone: this.listing.contact_phone,
        street_address: this.listing.street_address,
        apt_num: this.listing.apt_num,
        city: this.listing.city,
        state: this.listing.state,
        date_available: this.listing.date_available,
        monthly_price: this.listing.monthly_price,
        description: this.listing.description,
        num_beds: this.listing.num_beds,
        num_baths: this.listing.num_baths,
        square_ft: this.listing.square_ft
      }),
      csrf: CSRF,
      states: STATES,

      files: [],
      dropzoneOptions: {
        url: "/upload",
        headers: {
          "X-CSRF-TOKEN": CSRF
        },
        thumbnailWidth: 300,
        thumbnailHeight: 300,
        maxFilesize: 10, //10mb
        addRemoveLinks: true,
        paramName: "files",
        uploadMultiple: true,
        maxFiles: 20,
        //Messages
        dictDefaultMessage:
          '<i class="fa fa-upload"></i> Drag n\' Drop or Click to upload images',
        dictFileTooBig: "Please upload an image less than 10Mb",
        dictInvalidFileType:
          "Only images with extensions jpeg, png and svg are allowed ",
        dictResponseError:
          "There was an error uploading the image. Please remove it and try again.",
        dictCancelUploadConfirmation: "Upload cancelled",
        dictRemoveFile: "Remove image",
        dictMaxFilesExceeded:
          "You can only upload a maximum of 20 images at a time. Reload page to add more."
      }
    };
  },

  computed: {
    patchURL() {
      return "/listing/" + this.listing.id;
    }
  },

  methods: {
    onSubmit() {
      let _this = this;
      this.form
        .patch(this.patchURL)
        .then(response => _this.onSuccess())
        .catch(error => _this.onFailure());
    },
    onSuccess() {
      this.$emit("edited");
    },
    onFailure() {
      this.$emit("edit-failed");
    },
    closePopup() {
      this.$emit("hide");
    },
    editRequest(file, xhr, formData) {
      formData.append("listing_id", this.listing.id);
    }
  }
};
</script>
