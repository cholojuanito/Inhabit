<template>
	<div class="container has-top-margin">
		<div class="column is-6 is-offset-3">
			<div class="box">
				<!-- Steps section -->
				<div class="steps">
					<div
						class="step-item is-primary"
						:class="[step === 1 ? 'is-active' : '', step > 1 ? 'is-completed' : '']"
					>
						<div class="step-marker">
							<span class="icon">
								<i class="fa fa-home"></i>
							</span>
						</div>
						<div class="step-details">
							<p class="step-title">Property Info</p>
						</div>
					</div>
					<div
						class="step-item is-primary"
						:class="[step === 2 ? 'is-active' : '', step > 2 ? 'is-completed' : '']"
					>
						<div class="step-marker">
							<span class="icon">
								<i class="fa fa-file-contract"></i>
							</span>
						</div>
						<div class="step-details">
							<p class="step-title">Contract Info</p>
						</div>
					</div>
					<div class="step-item is-primary" :class="[step === 3 ? 'is-active' : '']">
						<div class="step-marker">
							<span class="icon">
								<i class="fa fa-camera"></i>
							</span>
						</div>
						<div class="step-details">
							<p class="step-title">Photos</p>
						</div>
					</div>
				</div>
				<!-- End steps section -->
				<hr>
				<form class="form-horizontal" @keyup="stepOneErrorCheck">
					<!-- STEP 1 -->
					<div v-if="step === 1">
						<div class="field">
							<label for="street_address" class="label">Address</label>
							<div class="control">
								<input
									ref="autocomplete"
									id="street_address"
									type="text"
									class="input"
									name="street_address"
									placeholder
								>
								<strong
									class="help is-danger"
									v-if="form.errors.has('street_address')"
								>Pleaes enter a valid address</strong>
							</div>
						</div>

						<div class="field is-less-wide">
							<label for="apt_num" class="label">Unit Number</label>
							<p class="help-text is-italizied">Optional</p>
							<div class="control">
								<input id="apt_num" type="text" class="input" name="apt_num" v-model="form.apt_num">
								<strong class="help is-danger" v-if="form.errors.has('apt_num')"></strong>
							</div>
						</div>

						<div class="field">
							<div class="control">
								<label class="label">Property Type</label>
								<p class="help-text is-italizied">Select one option</p>
								<div class="radio-wrapper">
									<input
										type="radio"
										id="apartment_id"
										name="Apartment"
										v-model="form.rental_type"
										value="Apartment"
										:checked="form.rental_type === 'Apartment'"
									>
									<label class="radio-label" for="apartment_id">Apartment</label>
									
									<input
										type="radio"
										id="studio_id"
										name="Studio"
										v-model="form.rental_type"
										value="Studio"
										:checked="form.rental_type === 'Studio'"
									>
									<label class="radio-label" for="studio_id">Studio</label>
									
									<input
										type="radio"
										id="condo_id"
										name="Condo"
										v-model="form.rental_type"
										value="Condo"
										:checked="form.rental_type === 'Condo'"
									>
									<label class="radio-label" for="condo_id">Condo</label>
									
									<input
										type="radio"
										id="sfh_id"
										name="Single Family Home"
										v-model="form.rental_type"
										value="Single Family Home"
										:checked="form.rental_type === 'Single Family Home'"
									>
									<label class="radio-label" for="sfh_id">Single Family Home</label>
									
									<input
										type="radio"
										id="th_id"
										name="Townhome"
										v-model="form.rental_type"
										value="Townhome"
										:checked="form.rental_type === 'Townhome'"
									>
									<label class="radio-label" for="th_id">Townhome</label>
								</div>
							</div>
						</div>

						<div class="field">
							<div class="control">
								<label for="num_beds" class="label">Number of Bedrooms</label>
								<div class="level">
									<div class="level-left">
										<div class="level-item">
											<span
												:class="this.form.num_beds <= 1 ? 'quantity-button-disabled' : 'quantity-button'"
												@click="decBed"
											>
												<span
													:class="this.form.num_beds <= 1 ? 'quantity-button-content-disabled' : 'quantity-button-content'"
												>
													<svg
														viewBox="0 0 24 24"
														role="img"
														aria-label="subtract bedrooms"
														focusable="false"
														style="height: 1em; width: 1em; display: block; fill: currentcolor;"
													>
														<rect height="2" rx="1" width="12" x="6" y="11"></rect>
													</svg>
												</span>
											</span>
											
											<input
												readonly
												class="quantity-input"
												type="number"
												id="num_beds"
												name="num_beds"
												v-model="form.num_beds"
											>
											
											<span
												:class="this.form.num_beds >= 5 ? 'quantity-button-disabled' : 'quantity-button'"
												@click="incBed"
											>
												<span
													:class="this.form.num_beds >= 5 ? 'quantity-button-content-disabled' : 'quantity-button-content'"
												>
													<svg
														viewBox="0 0 24 24"
														role="img"
														aria-label="add bedrooms"
														focusable="false"
														style="height: 1em; width: 1em; display: block; fill: currentcolor;"
													>
														<rect height="2" rx="1" width="12" x="6" y="11"></rect>
														<rect height="12" rx="1" width="2" x="11" y="6"></rect>
													</svg>
												</span>
											</span>
										</div>
										<div class="level-right">
											<!-- Needs to be blank for CSS -->
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="field">
							<div class="control">
								<label for="num_beds" class="label">Number of Bathrooms</label>
								<div class="level">
									<div class="level-left">
										<span
											:class="this.form.num_baths <= 1 ? 'quantity-button-disabled' : 'quantity-button'"
											@click="decBath"
										>
											<span
												:class="this.form.num_baths <= 1 ? 'quantity-button-content-disabled' : 'quantity-button-content'"
											>
												<svg
													viewBox="0 0 24 24"
													role="img"
													aria-label="subtract bathrooms"
													focusable="false"
													style="height: 1em; width: 1em; display: block; fill: currentcolor;"
												>
													<rect height="2" rx="1" width="12" x="6" y="11"></rect>
												</svg>
											</span>
										</span>
										
										<input
											readonly
											class="quantity-input"
											type="number"
											id="num_baths"
											name="num_baths"
											v-model="form.num_baths"
										>
										
										<span
											:class="this.form.num_baths >= 5 ? 'quantity-button-disabled' : 'quantity-button'"
											@click="incBath"
										>
											<span
												:class="this.form.num_baths >= 5 ? 'quantity-button-content-disabled' : 'quantity-button-content'"
											>
												<svg
													viewBox="0 0 24 24"
													role="img"
													aria-label="add bathrooms"
													focusable="false"
													style="height: 1em; width: 1em; display: block; fill: currentcolor;"
												>
													<rect height="2" rx="1" width="12" x="6" y="11"></rect>
													<rect height="12" rx="1" width="2" x="11" y="6"></rect>
												</svg>
											</span>
										</span>
									</div>
									<div class="level-right">
										<!-- Needs to be blank for CSS -->
									</div>
								</div>
							</div>
						</div>

						<div class="field is-less-wide">
							<label for="square_ft" class="label">Square Footage</label>
							<div class="control">
								<input
									type="number"
									class="input"
									id="square_ft"
									name="square_ft"
									v-model="form.square_ft"
									min="0"
								>
								<strong
									class="help is-danger"
									v-if="form.errors.has('square_ft')"
								>Please enter a valid number</strong>
							</div>
						</div>

						<div class="level">
							<div class="level-left">
								<!-- This needs to be blank for the button to go to the right -->
							</div>
							<div class="level-right">
								<div class="level-item">
									<div class="field">
										<div class="control">
											<input
												class="button is-primary"
												type="button"
												:value="nextText"
												:disabled="stepOneNextBtnDisabled === 1"
												@click="next"
											>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- END STEP 1 -->
				<!-- STEP 2 -->
				<form class="form-horizontal" @keyup="stepTwoErrorCheck" @submit.prevent="onSubmit">
					<div v-if="step === 2">
						<div class="field is-horizontal">
							<div class="field-body">
								<div class="field">
									<label for="date_available" class="label">Availability Date</label>
									<div class="control">
										<input
											type="date"
											class="input"
											id="date_available"
											name="date_available"
											v-model="form.date_available"
										>
										<strong
											class="help is-danger"
											v-if="form.errors.has('date_available')"
										>Please enter a valid date</strong>
									</div>
								</div>

								<div class="field is-expanded">
									<label for="monthly_price" class="label">Monthly Rate</label>
									<div class="field has-addons">
										<p class="control">
											<a class="button is-static">$</a>
										</p>
										<p class="control is-expanded">
											<input
												class="input"
												type="number"
												name="monthly_price"
												v-model="form.monthly_price"
												min="1"
											>
										</p>
									</div>
									<strong
										class="help is-danger"
										v-if="form.errors.has('monthly_price')"
									>Please enter a valid price</strong>
									<p class="help">Must be greater than zero.</p>
								</div>
							</div>
						</div>

						<div class="field">
							<label for="description" class="label">Description</label>

							<p
								class="help is-italizied"
							>This is your chance to tell about your experience living here. Also include any info you think is relevant.</p>
							<div class="description">
								<textarea id="description" class="textarea" name="description" v-model="form.description"></textarea>
								<strong
									class="help is-danger"
									v-if="form.errors.has('description')"
								>Please enter a brief description</strong>
							</div>
						</div>

						<div class="level">
							<div class="level-left">
								<div class="level-item">
									<div class="field">
										<div class="control">
											<input class="button is-outline" type="button" :value="backText" @click="back">
										</div>
									</div>
								</div>
							</div>
							<div class="level-right">
								<div class="level-item">
									<div class="field">
										<div class="control">
											<input
												type="submit"
												class="button is-primary"
												:value="nextText"
												:disabled="stepTwoNextBtnDisabled === 1"
											>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- END STEP 2 -->
				<!-- STEP 3 -->
				<form class="form-horizontal">
					<div v-if="step === 3">
						<div class="field">
							<div class="control">
								<p class="label">Upload Photos</p>
								<p class="help is-italizied">Max number of files is 20. Max filesize is 10mb.</p>
								<vue-dropzone
									id="dropzone"
									:options="dropzoneOptions"
									:destroyDropzone="false"
									@vdropzone-removed-file="removePhoto"
									@vdropzone-sending-multiple="addPhotos"
								></vue-dropzone>
								<!-- @vdropzone-sending="addPhotos" -->
							</div>
						</div>

						<div class="level">
							<div class="level-left">
								<div class="level-item">
									<div class="field">
										<div class="control">
											<input class="button is-outline" type="button" :value="backText" @click="back">
										</div>
									</div>
								</div>
							</div>
							<div class="level-right">
								<div class="level-item">
									<div class="field">
										<div class="control">
											<button class="button is-primary" type="button" @click="confirmPosted">Post Listing</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- END STEP 3 -->
			</div>
		</div>
	</div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.css";
export default {
	components: { VueDropzone: vue2Dropzone },
	data() {
		return {
			step: 1,
			nextText: "Next",
			backText: "Back",
			stepOneNextBtnDisabled: 1,
			stepTwoNextBtnDisabled: 1,
			form: new Form({
				street_address: null,
				city: null,
				state: null,
				zip_code: null,
				lat: null,
				lng: null,
				apt_num: null,
				date_available: null,
				rental_type: "Apartment",
				monthly_price: null,
				description: null,
				num_beds: 1,
				num_baths: 1,
				square_ft: null
			}),
			files: [],
			dropzoneOptions: {
				url: "/api/upload",
				headers: {
					"X-CSRF-TOKEN": CSRF,
					Authorization: "Bearer " + this.$auth.token()
				},
				thumbnailWidth: 300,
				thumbnailHeight: 300,
				maxFilesize: 10, //10mb
				addRemoveLinks: true,
				destroyDropzone: false,
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
	mounted() {
		this.autocomplete = new google.maps.places.Autocomplete(
			this.$refs.autocomplete,
			{ types: ["geocode"] }
		);

		this.autocomplete.addListener("place_changed", () => {
			let place = this.autocomplete.getPlace();
			let lat = place.geometry.location.lat();
			let lng = place.geometry.location.lng();
			let streetAdr = "";
			let city = "";
			let state = "";
			let zipCode = "";

			place.address_components.map(ac => {
				if (ac.types.includes("street_number")) {
					streetAdr += ac.short_name;
				}
				if (ac.types.includes("route")) {
					streetAdr += " " + ac.long_name;
				}
				if (ac.types.includes("locality")) {
					city = ac.short_name;
				}
				if (ac.types.includes("administrative_area_level_1")) {
					state = ac.short_name;
				}
				if (ac.types.includes("postal_code")) {
					zipCode = ac.short_name;
				}
			});
			// Add the query and other filters to the call
			this.form.street_address = streetAdr;
			this.form.city = city;
			this.form.state = state;
			this.form.zip_code = zipCode;
			this.form.lat = lat;
			this.form.lng = lng;
		});
	},
	methods: {
		next() {
			this.step++;
		},
		back() {
			this.step--;
		},
		incBed() {
			if (this.form.num_beds < 5.0) {
				this.form.num_beds++;
			}
		},
		decBed() {
			if (this.form.num_beds >= 1.5) {
				this.form.num_beds--;
			}
		},
		incBath() {
			if (this.form.num_baths < 5.0) {
				this.form.num_baths += 0.5;
			}
		},
		decBath() {
			if (this.form.num_baths >= 1.5) {
				this.form.num_baths -= 0.5;
			}
		},
		stepOneErrorCheck() {
			if (!!this.form.street_address && !!this.form.square_ft) {
				this.stepOneNextBtnDisabled = 0;
			} else {
				this.stepOneNextBtnDisabled = 1;
			}
		},
		stepTwoErrorCheck() {
			if (
				!!this.form.description &&
				!!this.form.date_available &&
				!!this.form.monthly_price
			) {
				this.stepTwoNextBtnDisabled = 0;
			} else {
				this.stepTwoNextBtnDisabled = 1;
			}
		},
		addPhotos(files, xhr, formData) {
			formData.append("listing_id", this.newListing.id);
		},
		removePhoto(file, error, xhr) {
			//   axios
			//     .delete("/upload/delete", {
			//       data: {
			//         file_name: file.name,
			//         file_size: file.size,
			//         listing_id: this.newListing.id
			//       }
			//     })
			//     .then(res => {
			//       this.showSuccess("File successfully removed");
			//     })
			//     .catch(errors => {
			//       this.showError("An error occurred while trying to remove a file");
			//     });
		},
		onSubmit() {
			this.$store
				.dispatch("listings/createListing", this.form)
				.then(data => {
					this.newListing = data;
					this.next();
				})
				.catch(errors => {
					this.showError(
						"Something went wrong while saving your listing. Check the form for details"
					);
				});
		},
		confirmPosted() {
			this.showSuccess(
				"Your listing has been saved. Others can now view it"
			);
			this.$store.commit("ADD_LISTING", this.newListing);
			this.$store.commit("ADD_FAVORITE_LISTING", this.newListing.id);
		},
		showSuccess(message) {
			this.$noty.success(message);
		},
		showError(message) {
			this.$noty.error(message);
		}
	}
};
</script>


<style lang="scss" scpoed>
.has-top-margin {
	margin-top: 10%;
}

.help-text {
	font-size: small;
	margin-bottom: 1px;
}

.is-italizied {
	font-style: italic;
}

.is-less-wide {
	width: 10em;
}

// Custom radio button styles
input[type="radio"] {
	position: absolute;
	opacity: 0;
	z-index: -1;
}

.radio-wrapper {
	label {
		font-weight: bold;
		position: relative;
		display: inline-block;
		margin-right: 10px;
		margin-bottom: 10px;
		padding-left: 10px;
		padding-right: 10px;
		line-height: 36px;
		border: 2px solid #008489;
		border-radius: 4px;
		cursor: pointer;
	}
	label::before {
		content: " ";
		position: absolute;
		top: 6px;
		left: 0;
		display: block;
		width: 24px;
		height: 24px;
		border: 2px solid #008489;
		border-radius: 4px;
		z-index: -1;
	}
	input[type="radio"] + label::before {
		border-radius: 18px;
	}
	/* Checked */
	input[type="radio"]:checked + label {
		padding-left: 10px;
		background-color: #008489;
		color: #fff;
	}

	input[type="radio"]:checked + label::before {
		top: 0;
		width: 100%;
		height: 100%;
		background: #008489;
	}
	/* Transition */
	label,
	label::before {
		-webkit-transition: 0.25s all ease;
		-o-transition: 0.25s all ease;
		transition: 0.25s all ease;
	}
}

//Custom number input styles

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

input[type="number"] {
	-moz-appearance: textfield;
}

.quantity-input {
	width: 2.5em !important;
	cursor: default !important;
	text-align: center !important;
	line-height: 1.65 !important;
	display: inline-block !important;
	padding: 0 !important;
	margin: 0 !important;
	border: none !important;
}

.quantity-button {
	display: inline-block !important;
	cursor: pointer !important;
	text-align: center !important;
	line-height: 1 !important;
	position: relative !important;
	width: 32px !important;
	height: 32px !important;
	box-shadow: none !important;
	border-radius: 50% !important;
	border-style: solid !important;
	border-color: #008489 !important;
	background: transparent !important;
	border-width: 1px !important;
}
.quantity-button:focus,
.quantity-button:active {
	box-shadow: 0 0 2px 2px #008489 !important;
}

.quantity-button-disabled {
	cursor: default !important;
	display: inline-block !important;
	text-align: center !important;
	line-height: 1 !important;
	position: relative !important;
	width: 32px !important;
	height: 32px !important;
	box-shadow: none !important;
	border-radius: 50% !important;
	border-style: solid !important;
	border-color: rgba(0, 132, 137, 0.3) !important;
	border-width: 1px !important;
	background: transparent !important;
}

.quantity-button-content {
	display: inline-block !important;
	position: absolute !important;
	top: 50% !important;
	left: 50% !important;
	transform: translate(-50%, -50%) !important;
	color: #008489 !important;
	font-size: 16px !important;
}

.quantity-button-content-disabled {
	display: inline-block !important;
	position: absolute !important;
	top: 50% !important;
	left: 50% !important;
	transform: translate(-50%, -50%) !important;
	color: rgba(0, 132, 137, 0.3) !important;
	font-size: 16px !important;
}
</style>
