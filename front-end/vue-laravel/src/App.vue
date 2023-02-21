<script >

import axios from 'axios';

const API_URL = 'http://localhost:8000/api/';
const API_VER = 'v1/';
const API = API_URL + API_VER;

const EMPTY_NEW_MOVIE = {
  tags_id: []
};

export default {

  data() {
    
    return {

      movies: [],
      genres: [],
      tags: [],

      new_movie: { ...EMPTY_NEW_MOVIE },

      state: {
        movieForm: false
      }
    }
  },
  methods: {
    
    editMovie(movie) {

      console.log('movie', movie);
      console.log('new_movie', this.new_movie);

      this.new_movie = { ...movie };

      this.new_movie.tags_id = [];
      for (let x=0;x<movie.tags.length;x++) {

        const tag = movie.tags[x];
        this.new_movie.tags_id.push(tag.id);
      }

      this.state.movieForm = true;
    },
    deleteMovie(movie) {

      axios.delete(API + 'movie/delete/' + movie.id)
           .then(res => {

              const data = res.data;
              const success = data.success;

              if (success) 
                this.updateData();
           })
           .catch(err => console.log);
    },
    submitMovie(e) {

      e.preventDefault();
      
      const new_movie = this.new_movie;
      const actualApi = API + (
        'id' in new_movie 
        ? 'movie/update/' + this.new_movie.id
        : 'movie/store'
      );

      console.log(new_movie);
      console.log(actualApi);

      axios.post(actualApi, new_movie)
           .then(res => {

              const data = res.data;
              const success = data.success;

              if (success) {

                this.closeForm();
                this.updateData();
              }
           })
           .catch(err => console.log);
    },
    closeForm() {

      this.new_movie = { ...EMPTY_NEW_MOVIE };
      this.state.movieForm = false;
    },
    updateData() {

      axios.get(API + 'movie/all')
           .then(res => {

              const data = res.data;
              const success = data.success;

              const response = data.response;

              const movies = response.movies;
              const genres = response.genres;
              const tags = response.tags;

              if (success) {

                this.movies = movies;
                this.genres = genres;
                this.tags = tags;
              }
           })
           .catch(err => console.log);
    }
  },
  mounted() {

    this.updateData();
  }
};

</script>

<template>
  <div class="container">
    <h1 class="my-5 text-white">Movies</h1>
    <form class="my-5" v-if="state.movieForm">
      <div class="form-group">
        <label for="name" class="text-white">Name</label>
        <input type="text" class="form-control" name="name" v-model="new_movie.name">
      </div>
      <div class="form-group">
        <label for="year" class="text-white">Year</label>
        <input type="number" class="form-control" name="year" v-model="new_movie.year">
      </div>
      <div class="form-group">
        <label for="cashOut" class="text-white">Cash out</label>
        <input type="number" class="form-control" name="cashOut" v-model="new_movie.cashOut">
      </div>
      <div class="form-group">
        <label for="genre" class="text-white">Genre</label>
        <select class="form-control" name="genre_id" v-model="new_movie.genre_id">
          <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name }}</option>
        </select>
      </div>
      <div class="form-group">
        <label class="text-white">Tags:</label>
        <div class="form-check" v-for="tag in tags" :key="tag.id">
          <input type="checkbox" class="form-check-input" :id="'tag-' + tag.id" :value="tag.id" v-model="new_movie.tags_id">
          <label class="form-check-label text-white" :for="'tag-' + tag.id">{{ tag.name }}</label>
        </div>
      </div>

      <button class="btn btn-secondary mr-3" @click="closeForm">CANCEL</button>
      <input type="submit" class="btn btn-primary" @click="submitMovie" :value="'id' in new_movie ? 'UPDATE MOVIE: ' + new_movie.id : 'CREATE NEW MOVIE'">
    </form>
    <div class="my-5" v-else>
      <button class="btn btn-primary mb-3" @click="state.movieForm = true">CREATE NEW MOVIE</button>
      <div class="row">
        <div class="col-md-3 mb-4" v-for="movie in movies" :key="movie.id">
          <div class="card bg-dark text-white">
            <img class="card-img-top" :src="movie.poster" alt="Movie Poster">
            <div class="card-body">
              <h5 class="card-title">{{ movie.name }}</h5>
              <p class="card-text">{{ movie.year }}</p>
              <p class="card-text">{{ movie.cashOut }}</p>
              <ul class="list-unstyled">
                <li v-for="tag in movie.tags" :key="tag.id">
                  <span class="badge badge-secondary">{{ tag.name }}</span>
                </li>
              </ul>
              <button class="btn btn-secondary mr-3" @click="editMovie(movie)">EDIT</button>
              <button class="btn btn-danger" @click="deleteMovie(movie)">DELETE</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
  font-size: 48px;
  font-weight: bold;
  color: #fff;
  text-align: center;
  margin-bottom: 30px;
}

.card {
  background-color: #141414;
  color: #fff;
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 30px;
}

.card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-body {
  padding: 20px;
}

.card-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.card-text {
  font-size: 18px;
  margin-bottom: 10px;
}

.btn {
  font-size: 20px;
  font-weight: bold;
  padding: 10px 20px;
  margin-right: 10px;
  border-radius: 5px;
  text-transform: uppercase;
}

.btn-primary {
  background-color: #e50914;
  border-color: #e50914;
}

.btn-primary:hover {
  background-color: #e50914;
  border-color: #e50914;
}

.btn-secondary {
  background-color: #222;
  border-color: #222;
}

.btn-secondary:hover {
  background-color: #333;
  border-color: #333;
}

.form-control {
  background-color: #141414;
  color: #fff;
  border-radius: 5px;
  border: none;
}

.form-group label {
  font-size: 20px;
  font-weight: bold;
  color: #fff;
  margin-bottom: 10px;
}

.form-check-label {
  font-size: 18px;
  color: #fff;
  margin-left: 5px;
}

.form-check-input:checked+.form-check-label::before {
  content: '\f14a';
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  color: #e50914;
}

.list-unstyled li {
  display: inline-block;
  margin-right: 10px;
}

.list-unstyled li:last-of-type {
  margin-right: 0;
}


</style>