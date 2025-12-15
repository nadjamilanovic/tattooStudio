let ArtistService = {
    init: function() {
        ArtistService.getAllArtists();
    },

    getAllArtists: function() {
        RestClient.get("artists", function(data) {
            Utils.datatable("artists-table", [
                { data: "name", title: "Name" },
                { data: "specialty", title: "Specialty" },
                {
                    title: "Actions",
                    render: function(data, type, row) {
                        const rowStr = encodeURIComponent(JSON.stringify(row));
                        return `
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <button class="btn btn-primary" onclick="ArtistService.openEditModal('${row.id}')">Edit</button>
                                <button class="btn btn-danger" onclick="ArtistService.openConfirmationDialog(decodeURIComponent('${rowStr}'))">Delete</button>
                            </div>
                        `;
                    }
                }
            ], data, 10);
        });
    },

    addArtist: function(artist) {
        RestClient.post("artists", artist, function() {
            toastr.success("Artist added successfully");
            ArtistService.getAllArtists();
            ArtistService.closeModal();
        });
    },

    editArtist: function(artist) {
        RestClient.patch("artists/" + artist.id, artist, function() {
            toastr.success("Artist updated successfully");
            ArtistService.getAllArtists();
            ArtistService.closeModal();
        });
    },

    deleteArtist: function() {
        const id = $("#delete_artist_id").val();
        RestClient.delete("artists/" + id, null, function() {
            toastr.success("Artist deleted successfully");
            ArtistService.getAllArtists();
            ArtistService.closeModal();
        });
    },

    openAddModal: function() {
        $("#addArtistModal").show();
    },

    openEditModal: function(id) {
        $("#editArtistModal").show();
        RestClient.get("artists/" + id, function(data) {
            $('input[name="name"]').val(data.name);
            $('input[name="specialty"]').val(data.specialty);
            $('input[name="id"]').val(data.id);
        });
    },

    openConfirmationDialog: function(artist) {
        artist = JSON.parse(artist);
        $("#deleteArtistModal").modal("show");
        $("#delete-artist-body").html("Do you want to delete artist: " + artist.name + "?");
        $("#delete_artist_id").val(artist.id);
    },

    closeModal: function() {
        $("#addArtistModal").hide();
        $("#editArtistModal").hide();
        $("#deleteArtistModal").modal("hide");
    }
};
